<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $categoriesForm = $this->createForm(ArticleFilterType::class);

        $categoriesForm->handleRequest($request);

        $categoriesFilter = [];

        if ($categoriesForm->isSubmitted() && $categoriesForm->isValid()) {
            $categoriesFilter = $categoriesForm->getData()['categories'];
        }

        if (\count($categoriesFilter) > 0) {
            $articles = $this
                ->getDoctrine()
                ->getRepository(Article::class)
                ->findArticleByCategoryIds($categoriesFilter)
            ;
        } else {
            $articles = $this
                ->getDoctrine()
                ->getRepository(Article::class)
                ->findAll()
            ;
        }

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
            'categoriesForm' => $categoriesForm->createView(),
        ]);
    }
}
