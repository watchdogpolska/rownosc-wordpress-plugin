<?php
namespace Rownosc\Api\Services;


use Rownosc\Api\ApiClient;

class ArticleServiceEntity extends BaseEntityApiService
{
    public function __construct(ApiClient $client)
    {
        parent::__construct($client, 'article');
    }

    public function index($page = 1)
    {
        $path = sprintf('bibliography/article/?page=%d', $page);
        $response = $this->client->get_request($path);
        return $this->parse_list_result($response);
    }

    public function get($id = 1)
    {
        $path = sprintf('bibliography/article/%d/', $id);
        $response = $this->client->get_request($path);
        return $this->parse_single_result($response);
    }

}