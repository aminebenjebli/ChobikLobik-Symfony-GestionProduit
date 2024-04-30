<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlatRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Plat;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Repository\OffreRepository;
use Endroid\QrCode\QrCode;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Endroid\QrCode\Builder\BuilderInterface; 
use Endroid\QrCode\Writer\Result\PngResult;

class GerantFrontController extends AbstractController
{
    #[Route('/Gerant', name: 'app_gerant')]
    public function index(): Response
    {

        return $this->render('gerant/index.html.twig', [
            'controller_name' => 'GerantFrontController',
        ]);
    }
    #[Route('/stat',name:'plat-stat')]
    public function StatPrixMoyenParCategories(PlatRepository $produitRepository, CategoryRepository $categoryRepository , ManagerRegistry $emm): Response
{
    $categories = $categoryRepository->findAll();
    $prixMoyenParCategorie = [];

    foreach ($categories as $categorie) {
        $plats = $produitRepository->findBy(['idCategory' => $categorie->getId()]);
        $totalPrix = 0;
        $nombrePlat = count($plats);

        foreach ($plats as $plat) {
            $totalPrix += $plat->getPrix();
        }

        $prixMoyen = $nombrePlat > 0 ? $totalPrix / $nombrePlat : 0;
        $prixMoyenParCategorie[$categorie->getType()] = $prixMoyen;
    }
    
    // Passer les noms des catégories également à la vue
    $nomsCategories = array_keys($prixMoyenParCategorie);

    return $this->render('gerant/VariationPrixProd.html.twig', [
        'categories' => array_values($prixMoyenParCategorie), // Utilisez array_values pour obtenir les valeurs du tableau associatif
        'nomsCategories' => $nomsCategories,
    ]);
}
#[Route('/aff',name:'gerant-affich')]
function affichAuthor(PlatRepository $repo, Request $request, PaginatorInterface $paginator): Response {
    $query = $repo->createQueryBuilder('p')->getQuery();
    $plats = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1),
        6
    );
    return $this->render('gerant/ListPlat.html.twig', ['prod' => $plats]);
}
private $qrCodeBuilder;
public function __construct(BuilderInterface $qrCodeBuilder)
    {
        $this->qrCodeBuilder = $qrCodeBuilder;
    }



    
#[Route('/aff-offre', name: 'gerant-affich-offre')]
function affichOffre(OffreRepository $repo, Request $request, PaginatorInterface $paginator): Response {
    $query = $repo->createQueryBuilder('o')->getQuery();
    $offres = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1),
        6
    );
    
    foreach ($offres as $offre) {
        // Customize the QR code data
        $qrCodeResult = $this->qrCodeBuilder
            ->data($offre->getIdPlat()->getDescription() . ' - ' . $offre->getPourcentage())
            ->build();

        // Convert the QR code result to a string representation
        $qrCodeString = $this->convertQrCodeResultToString($qrCodeResult);

        // Add the QR code string to the Offre entity
        $offre->getIdPlat()->setQrCode($qrCodeString);
    }

    return $this->render('gerant/ListOffre.html.twig', ['offres' => $offres]);
}

private function convertQrCodeResultToString(PngResult $qrCodeResult): string
    {
        // Convert the result to a string (e.g., base64 encode the image)
        // Adjust this logic based on how you want to represent the QR code data
        return 'data:image/png;base64,' . base64_encode($qrCodeResult->getString());
    }

}

