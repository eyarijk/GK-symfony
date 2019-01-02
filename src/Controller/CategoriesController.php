<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoriesController.
 */
class CategoriesController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll()
        ;

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($category);

            $entityManager->flush();

            return $this->redirectToRoute('categories_show', [
                'slug' => $category->getSlug(),
            ]);
        }

        return $this->render('categories/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Category $category
     * @return Response
     */
    public function show(Category $category): Response
    {
        return $this->render('categories/show.html.twig', [
            'category' => $category,
        ]);
    }
}
