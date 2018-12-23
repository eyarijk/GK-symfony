<?php

namespace App\Controller;

use App\Service\NewsApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends AbstractController
{
    public function index(Request $request): Response
    {
        $q = $request->get('searchQuery', 'symfony');

        $fromDate = new \DateTime($request->get('from') ?? 'now');

        $articles = (new NewsApiClient(getenv('NEWS_API_KEY')))
            ->setDate($fromDate)
            ->getNews($q);

        return $this->render('news/index.html.twig', [
            'articles' => $articles,
            'newsQuery' => $q,
            'fromDate' => $fromDate,
            'articlesCount' => \count($articles),
        ]);
    }
}
