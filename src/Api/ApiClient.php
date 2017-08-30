<?php

namespace Rownosc\Api;

// curl -X GET http://rownosc.info/api/v1/bibliography/biblio/ -H 'Authorization: Token ca57f750c5340ff659b11e0abf2fbfedff4ac5c5'

use Rownosc\Options;

class ApiClient {

    const CACHE_KEY = 'HTTP_API:';
    private $base_path;

    private $credentials;

    /**
     * R_Api_Client constructor.
     * @param $base_path
     */
    public function __construct($base_path)
    {
        $this->base_path = $base_path;
    }


    public function get_request ($path)
    {
        if (false !== ($result = r_cache_get(self::CACHE_KEY . $path)) ){
            return $result;
        }

        $headers = array();

        if ($this->credentials != null) {
            $headers['Authorization'] = $this->credentials;
        };

        $site_id = intval(r_get_option('site_id', 0));
        if ($site_id) {
        	if (strpos($path, '?') !== false) {
		        $path = $path . '&sites=' . $site_id;
	        } else {
        		$path = $path . '?sites=' . $site_id;
	        }
        }
        $url = $this->base_path . $path;

        $response = wp_remote_get( $url, array(
            'headers' => $headers
        ));

        if (is_wp_error($response) || !$this->is_success(intval($response['response']['code']))) {
            return $response;
        } else {
            $result = json_decode(wp_remote_retrieve_body($response), true);
            r_cache_set(self::CACHE_KEY . $path, $result);
            return $result;
        }
    }

    private function is_success ($sc)
    {
        return $sc >= 100 && $sc < 200;
    }

    public function set_base_path ( $base_path ){
        $this->base_path = $base_path;
    }

    public function set_access_token ($access_token)
    {
        if ($access_token != null) {
            $this->credentials = 'Token ' . $access_token;
        } else {
            $this->credentials = null;
        }
    }

}
