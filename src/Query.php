<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 08.07.17
 * Time: 19:57
 */

namespace Rownosc;


use Rownosc\Api\Api;

class Query
{
    /** @var $api Api */
    private $api;
    public $response;

    /**
     * Gets filled with the requested objects from the remote server.
     * @var array[][]
     */
    public $objects;
    /**
     * The number of object being displayed.
     * @var int
     */
    public $object_count;
    /**
     * The total number of objects found matching the current query parameters
     * @var int
     */
    public $found_objects;
    /**
     * The total number of pages.
     * @var
     */
    public $max_num_pages;

    public $is_single = false;
    public $is_index = false;
    public $is_root = false;

    public $in_the_loop = false;
    private $services;


    function __construct()
    {
    }

    function init() {
        add_action('found_posts', array( $this, 'parse_remote_data' ) );
        $this->api = new Api(r_get_option('base_path'));
        $this->api->getClient()->set_access_token(r_get_option('token'));
        $this->registerModules();
    }

    public function registerModules()
    {
        $biblio_service = $this->api->getBibliography();
        $this->services = array();
        $this->services['publication'] = $biblio_service->getPublication();
        $this->services['article'] = $biblio_service->getArticle();
        $this->services['document'] = $biblio_service->getDocument();
        $this->services['journal'] = $biblio_service->getJournal();
        $this->services['multimedium'] = $biblio_service->getMultimedium();
        $this->services['research'] = $biblio_service->getResearch();
	    $this->services['search'] = $this->api->getSearch();


    }

    function parse_remote_data($posts) {

	    $action = get_query_var('r_action', '');

	    if (!$action) {
	    	return $posts;
	    }

	    if ($action == 'search') {
	    	$this->fetch_search_results();

	    	return $posts;
	    }

	    $object_type = get_query_var('r_object_type', '');

	    if (!isset($this->services[$object_type])) {
		    $this->throw404();
		    return $posts;
	    };

	    switch($action) {
		    case 'single':
			    $object_id = intval(get_query_var('r_object_id', ''));
			    $this->fetch_single($object_type, $object_id);
			    break;
		    case 'archive':
			    $this->fetch_list($object_type);
			    break;
	    }

        return $posts;
    }

    private function throw404()
    {
        global $wp_query;
        $wp_query->set_404();
    }

    private function fetch_search_results() {
		$search_query = trim(r_get_search_query(false));
		if (!$search_query) {
			$this->response = array();
		}
	    $page = max(get_query_var('paged', 1), 1);
	    $response = $this->services['search']->search($search_query, $page);
	    if (is_wp_error($response)) {
		    $this->throw404();
		    return;
	    }
	    $this->response = $response['results'];
	    $this->object_count = count($response['results']);
	    $this->found_objects = $response['count'];
	    $this->max_num_pages = floor($this->found_objects / 50);
    }

    private function fetch_list($object_type)
    {
        $page = max(get_query_var('paged', 1), 1);
        $response = $this->services[$object_type]->index($page);
        if(is_wp_error($response)) {
            $this->throw404();
            return;
        }
	    $this->response = $response['results'];
	    $this->object_count = count($response['results']);
	    $this->found_objects = $response['count'];
	    $this->max_num_pages = floor($this->found_objects / 50);
    }

    private function fetch_single($object_type, $object_id)
    {
        $response = $this->services[$object_type]->get($object_id);

        if(is_wp_error($response)) {
            $this->throw404();
            return;
        }

        $this->response = $response;
    }


}