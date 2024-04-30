<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller;
use App\Repository\PlatRepository;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }


    
    #[Route('/categorie/add', name: 'CategorieAdd')]
    public function addCategorie(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategorieType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('CategorieShow');
        }

        return $this->render('categorie/addCat.html.twig', [
            'formCategorie' => $form->createView(),
        ]);
    }
    #[Route('/categorie/show', name: 'CategorieShow')]
public function showCategories(CategoryRepository $categoryRepository): Response
{
    $categories = $categoryRepository->findAll();

    return $this->render('categorie/show.html.twig', [
        'categories' => $categories,
    ]);
}
#[Route('/categorie/edit/{id}', name: 'CategorieEdit')]
public function editCategorie(Request $request, Category $category): Response
{
    $form = $this->createForm(CategorieType::class, $category);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('CategorieShow');
    }

    return $this->render('categorie/editCat.html.twig', [
        'formCategorie' => $form->createView(),
    ]);
}
#[Route('/categorie/delete/{id}', name: 'CategorieDelete')]
public function deleteCategorie(Request $request, Category $category): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($category);
    $entityManager->flush();

    return $this->redirectToRoute('CategorieShow');
}

#[Route('/categorie/search', name: 'categorie_search', methods: ['GET'])]
public function search(Request $request, CategoryRepository $categoryRepository): Response
{
    $query = $request->query->get('query');
    $categories = $categoryRepository->findAll(); // Get all categories from the repository

    // Filter categories based on the search query
    if ($query) {
        $categories = array_filter($categories, function ($category) use ($query) {
            return stripos($category->getType(), $query) !== false;
        });
    }

    return $this->render('categorie/show.html.twig', [
        'categories' => $categories,
    ]);
}


#[Route('/categorie/tri', name: 'categorie_tri')]
public function tri(Request $request, CategoryRepository $categoryRepository): Response
{
    $tri = $request->query->get('tri', 'alphabetic_asc'); // Par défaut, tri alphabétique croissant

    switch ($tri) {
        case 'alphabetic_desc':
            $categories = $categoryRepository->findBy([], ['type' => 'DESC']);
            break;
        default: // Tri alphabétique croissant
            $categories = $categoryRepository->findBy([], ['type' => 'ASC']);
    }

    return $this->render('categorie/show.html.twig', [
        'categories' => $categories,
    ]);
}



#[Route('/detailleCat', name: 'detaillCat')]
public function showProductsByCategory($id, CategoryRepository $categoryRepository, PlatRepository $platRepository): Response
{
    $category = $categoryRepository->find($id);

    if (!$category) {
        throw $this->createNotFoundException('La catégorie demandée n\'existe pas.');
    }

    $products = $platRepository->findByCategory($category);

    return $this->render('categorie/listP.html.twig', [
        'category' => $category,
        'products' => $products,
    ]);
}

}
