<?php
namespace Rownosc\Api\Services;


use Rownosc\Api\ApiClient;

class DocumentServiceEntity extends BaseEntityApiService
{
    public function __construct(ApiClient $client)
    {
        parent::__construct($client, 'document');
    }

    public function index($page = 1)
    {
        $path = sprintf('bibliography/document/?page=%d', $page);
        $response = $this->client->get_request($path);
        return $this->parse_list_result($response);
    }

    public function get($id = 1)
    {
        $path = sprintf('bibliography/document/%d/', $id);
        $response = $this->client->get_request($path);
        return $this->parse_single_result($response);
    }

}