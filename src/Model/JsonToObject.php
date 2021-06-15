<?php

namespace App\Model;

use App\Model\CocktailApiClient;

class JsonToObject
{

    private CocktailApiClient $apiClient;

    public function __construct(CocktailApiClient $apiClient)
    {

        $this->apiClient= $apiClient;

    }


    public function converToObject(){

        $decoded = json_decode($this->apiClient->fetchCocktailsByFirstLetter('e'));


        foreach( $decoded as $stdObject){





        }


        return $decoded;
    }




}
