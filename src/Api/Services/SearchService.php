<?php
namespace Rownosc\Api\Services;


use Rownosc\Api\ApiClient;

class SearchService extends BaseApiService
{
    public function __construct(ApiClient $client)
    {
        parent::__construct($client, 'research');
    }

    public function search($query, $page = 1)
    {
        $path = sprintf('search/?q=%s&page=%d', $query, $page);
        $response = $this->client->get_request($path);

	    if (!$this->is_ok($response)) {
		    return $response;
	    }

	    $result = json_decode(wp_remote_retrieve_body($response), true);

	    return $result;
    }

}