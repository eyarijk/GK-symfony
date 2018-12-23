<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $categoriesFilter = $request->get('categories',[]);

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

        $categories = $this
            ->getDoctrine()
            ->getRepository(Category::class)
            ->getOptionsForFilter()
        ;

        return $this->render('articles/index.html.twig',[
            'articles'          => $articles,
            'categories'        => $categories,
            'categoriesFilter'  => $categoriesFilter
        ]);
    }
}
