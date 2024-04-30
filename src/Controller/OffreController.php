<?php

namespace App\Controller;

use App\Entity\OffreResto;
use App\Entity\Plat;
use App\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OffreRepository;


class OffreController extends AbstractController

{
    #[Route('/offre', name: 'offre_index')]
public function index(): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $offres = $entityManager->getRepository(OffreResto::class)->findAll();

    return $this->render('offre/index.html.twig', [
        'offres' => $offres,
    ]);
}
#[Route('/offre/add', name: 'offre_add')]
public function add(Request $request): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $plats = $entityManager->getRepository(Plat::class)->findAll();

    $offre = new OffreResto();
    $form = $this->createForm(OffreType::class, $offre);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Set the plat for the offer
        $plat = $form->get('idPlat')->getData();
        $offre->setIdPlat($plat);

        // Calculate and set the new price
        $percentage = $form->get('pourcentage')->getData();
        $oldPrice = $plat->getPrix(); // Assuming 'price' is the property name for the price of a plat
        $newPrice = $oldPrice * (1 + $percentage / 100);
        $offre->setNewPrice($newPrice);

        $entityManager->persist($offre);
        $entityManager->flush();

        $this->addFlash('success', 'Offer added successfully.');

        return $this->redirectToRoute('offre_index');
    }

    return $this->render('offre/add.html.twig', [
        'form' => $form->createView(),
        'plats' => $plats,
    ]);
}

    #[Route('/offre/{id}/delete', name: 'offre_delete')]
public function delete(Request $request, OffreResto $offre): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($offre);
    $entityManager->flush();

    $this->addFlash('success', 'Offer deleted successfully.');

    return $this->redirectToRoute('offre_index');
}
#[Route('/offre/{id}/edit', name: 'offre_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, OffreResto $offre, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(OffreType::class, $offre);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        $this->addFlash('success', 'Offer updated successfully.');
        return $this->redirectToRoute('offre_index'); // Make sure 'offre_index' is the correct route
    }

    return $this->render('offre/edit.html.twig', [
        'offre' => $offre, // Ensure 'offre' is used if needed for context in the template
        'form' => $form->createView(),
    ]);
}
#[Route('/offre/search', name: 'offre_search', methods: ['GET'])]
public function search(Request $request, OffreRepository $offreRepository): Response
{
    $query = $request->query->get('query');
    $offers = $offreRepository->searchByPlatNameAndPercentage($query);

    return $this->render('offre/_searchResults.html.twig', [
        'offers' => $offers,
    ]);
}
#[Route('/offre/tri', name: 'offre_tri')]
public function tri(Request $request, OffreRepository $offreRepository): Response
{
    $tri = $request->query->get('tri', 'percentage_asc'); // Default sorting by percentage ascending

    switch ($tri) {
        case 'percentage_asc':
            $offres = $offreRepository->findBy([], ['pourcentage' => 'ASC']);
            break;
        case 'percentage_desc':
            $offres = $offreRepository->findBy([], ['pourcentage' => 'DESC']);
            break;
        case 'date_asc':
            $offres = $offreRepository->findBy([], ['dateDebut' => 'ASC']);
            break;
        case 'date_desc':
            $offres = $offreRepository->findBy([], ['dateDebut' => 'DESC']);
            break;
        default:
            $offres = $offreRepository->findAll();
            break;
    }

    return $this->render('offre/index.html.twig', [
        'offres' => $offres,
    ]);
}
#[Route('/offre/delete-expired', name: 'delete_expired_offers')]
public function deleteExpiredOffers(EntityManagerInterface $entityManager): Response
{
    $currentDate = new \DateTime();
    $repository = $entityManager->getRepository(OffreResto::class);
    $expiredOffers = $repository->createQueryBuilder('o')
        ->where('o.dateFin < :currentDate')
        ->setParameter('currentDate', $currentDate)
        ->getQuery()
        ->getResult();

    foreach ($expiredOffers as $expiredOffer) {
        $entityManager->remove($expiredOffer);
    }

    $entityManager->flush();

    $this->addFlash('success', count($expiredOffers) . ' expired offers deleted successfully.');

    return $this->redirectToRoute('offre_index');
}


}
