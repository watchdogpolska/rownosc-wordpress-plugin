<?php

namespace Rownosc\Api\Services;

use Rownosc\Api\ApiClient;

abstract class BaseEntityApiService extends BaseApiService {

    protected $name;

    /**
     * R_Api_Service constructor.
     * @param $client
     */
    public function __construct(ApiClient $client, $name)
    {
	    parent::__construct($client);
        $this->name = $name;
    }

    protected function parse_single_result($response){
        $result = $this->parse_response($response);
        $this->add_type_signature($result);
        return $result;
    }

    protected function parse_list_result($response){
        if (!$this->is_ok($response)) {
            return $response;
        }
        $result = $this->parse_response($response);
        array_walk($result['results'], array( $this, 'add_type_signature' ) );
        return $result;
    }

    protected function add_type_signature(&$result){
        $result['_type'] = $this->name;
    }

}