<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 29.08.17
 * Time: 09:15
 */

namespace Rownosc\Api\Services;

use Rownosc\Api\ApiClient;

class BaseApiService {
	/**
	 * @var ApiClient
	 */
	protected $client;

	/**
	 * R_Api_Service constructor.
	 * @param $client
	 */
	public function __construct(ApiClient $client)
	{
		$this->client = $client;
	}

	protected function parse_response($response) {
		return json_decode(wp_remote_retrieve_body($response), true);
	}

	protected function parse_single_result($response){
		$result = $this->parse_response($response);
		return $result;
	}

	protected function parse_list_result($response){
		if (!$this->is_ok($response)) {
			return $response;
		}
		$result = $this->parse_response($response);
		return $result;
	}


	protected function is_ok($response)
	{
		return !is_wp_error($response);
	}
}