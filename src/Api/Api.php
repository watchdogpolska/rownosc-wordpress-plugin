<?php

namespace Rownosc\Api;

use Rownosc\Api\Services\BibliographyEntityApiService;
use Rownosc\Api\Services\SearchService;

class Api
{

    /** @var ApiClient client */
    public $client;
    private $modules = array();

    function __construct($base_path)
    {
        $this->client = new ApiClient($base_path);
    }

    function getBibliography() {
        return new BibliographyEntityApiService($this->client);
    }

    function getSearch() {
    	return new SearchService($this->client);
    }

    /**
     * @return ApiClient
     */
    public function getClient()
    {
        return $this->client;
    }



}