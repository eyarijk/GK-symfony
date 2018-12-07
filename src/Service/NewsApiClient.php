<?php

namespace App\Service;

class NewsApiClient
{
    /**
     * API uri for news
     */
    public const URL = 'https://newsapi.org/v2/everything';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Default now
     * @var \DateTime
     */
    private $dateFrom;

    /**
     * Default sortBy = publishedAt
     * @var string
     */
    private $sortBy;

    /**
     * constructor.
     * @param string $apiKey
     * @param string $sortBy
     */
    public function __construct(string $apiKey,string $sortBy = 'publishedAt')
    {
        $this->apiKey = $apiKey;
        $this->sortBy = $sortBy;
        $this->setDate(new \DateTime());
    }

    /**
     * @param \DateTime $date
     * @return NewsApiClient
     */
    public function setDate(\DateTime $date): self
    {
        $this->dateFrom = $date;
        return $this;
    }

    /**
     * @param string $sortBy
     * @return NewsApiClient
     */
    public function setSortBy(string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * @param string $query
     * @return \array
     */
    public function getNews(string $query): array
    {
        $jsonDate = $this->makeRequest($query);
        return json_decode($jsonDate)->articles;
    }

    /**
     * @param string $query
     * @return string
     */
    private function makeRequest(string $query): string
    {
        $params = http_build_query([
            'q'      => $query,
            'from'   => $this->dateFrom->format('Y-m-d'),
            'sortBy' => $this->sortBy,
            'apiKey' => $this->apiKey
        ]);

        return file_get_contents(self::URL.'?'.$params);
    }
}