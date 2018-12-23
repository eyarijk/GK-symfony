<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFilterType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends AbstractController
{
    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
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
                ->findArticleByCategoriesQuery($categoriesFilter)
            ;
        } else {
            $articles = $this
                ->getDoctrine()
                ->getRepository(Article::class)
                ->createQueryBuilder('a')
                ->getQuery()
            ;
        }

        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
            'categoriesForm' => $categoriesForm->createView(),
        ]);
    }

    /**
     * @ParamConverter("start", options={"format" : "Y-m-d"})
     * @ParamConverter("finish", options={"format" : "Y-m-d"})
     * @param \DateTime $start
     * @param \DateTime $finish
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function showByPeriod(\DateTime $start, \DateTime $finish, PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findByPeriodQuery($start, $finish)
        ;

        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
