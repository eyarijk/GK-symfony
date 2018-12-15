<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class CategoriesController
 * @package App\Controller
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

        return $this->render('categories/index.html.twig',compact('categories'));
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

            return $this->redirectToRoute('categories.show',[
                'slug' => $category->getSlug()
            ]);
        }

        return $this->render('categories/create.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @param string $slug
     * @return Response
     */
    public function show(string $slug): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy([
                'slug' => $slug
            ])
        ;

        if ($category === null) {
            return new Response('Page not found. Category slug: '.$slug, Response::HTTP_NOT_FOUND);
        }

        return $this->render('categories/show.html.twig',compact('category'));
    }
}