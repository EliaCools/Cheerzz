<?php


namespace App\Model;


use Google_Client;
use Google_Service_YouTube;
use Symfony\Component\Config\Definition\Exception\Exception;

class YoutubeApiClient
{

    private string $apikey;

    public function __construct(string $apikey)
    {

        $this->apikey = $apikey;
    }

    private function apirequest(string $cocktailName){
        /**
         * Sample PHP code for youtube.search.list
         * See instructions for running these code samples locally:
         * https://developers.google.com/explorer-help/guides/code_samples#php
         */

   //    if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
   //        throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
   //    }
   //    require_once __DIR__ . '/vendor/autoload.php';

        $client = new Google_Client();
        $client->setApplicationName('API code samples');
        $client->setScopes([
            'https://www.googleapis.com/auth/youtube.force-ssl',
        ]);
        $client->setDeveloperKey($this->apikey);


// Define service object for making API requests.
        $service = new Google_Service_YouTube($client);

        $queryParams = [
            'maxResults' => 1,
            'q' => 'how to make a ' . $cocktailName .' cocktail',
            'type' => 'video',
            'videoEmbeddable' => 'true'
        ];

        $response = $service->search->listSearch('snippet', $queryParams);
        return $response;


    }

    public function getVideoUrl(string $cocktailName) : string{

        $rawData = $this->apirequest($cocktailName);

        return "https://www.youtube.com/watch?v=" . $rawData->getItems()[0]->getId()->getVideoId();


    }
    public function getTitle(string $cocktailName) : string{

        $rawData = $this->apirequest($cocktailName);

        return $rawData->getItems()[0]->getSnippet()->getTitle();


    }
    public function getDescription(string $cocktailName) : string{

        $rawData = $this->apirequest($cocktailName);

        return $rawData->getItems()[0]->getSnippet()->getDescription();


    }

}
