<?php
declare(strict_types=1);

namespace App\Model;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CocktailApiClient
{
    private HttpClientInterface $client;
    private const SOURCE = 'https://www.thecocktaildb.com/api/json/v1/1/';
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchCocktailsByFirstLetter(string $character): string
    {
        $response = $this->client->request(
            'GET',
            self::SOURCE . 'search.php?f=a',
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
//        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;

    }
}