<?php

namespace Rownosc;

class Rewrite {

    function __construct()
    {
        add_action('init', array( $this, 'add_rewrite_tags') );
	    add_action('init', array( $this, 'add_query_vars') );


	    add_action('rewrite_rules_array', array($this, 'add_rewrite_rules'));
    }

    function add_rewrite_rules($rules) {
        global $wp_rewrite;

        $prefix = $this->get_prefix_permastruct();

	    $new_rules = array();
	    $new_rules[$prefix . '/search/?$'] = 'index.php?r_action=search';
	    $new_rules[$prefix . '/([a-z]+)/page/?([0-9]{1,})/?$'] = 'index.php?r_action=archive&r_object_type=$matches[1]&paged=$matches[2]';
		$new_rules[$prefix . '/([a-z]+)/?$'] = 'index.php?r_action=archive&r_object_type=$matches[1]';
        $new_rules[$prefix . '/([a-z]+)/([0-9]+)/([^/]+?)/?$'] = 'index.php?r_action=single&r_object_type=$matches[1]&r_object_id=$matches[2]&r_object_slug=$matches[3]';

		$endpoint_page_id = r_get_option('endpoint_page');

        $new_rules = preg_filter('/$/', '&page_id=' . $endpoint_page_id, $new_rules);

        return array_merge($new_rules, $rules);
    }

    function add_rewrite_tags() {
	    add_rewrite_tag('%r_action%','([a-z]+)');
	    add_rewrite_tag('%r_object_type%','([a-z]+)');
        add_rewrite_tag('%r_object_id%','([0-9]+)');
        add_rewrite_tag('%r_object_slug%','([^/]+?)');
    }

	function add_query_vars() {
		global $wp;
		$wp->add_query_var('r_q');
	}

    function get_endpoint_title()
    {
    	if (r_is_action_page('archive')) {
		    $type_key = get_query_var('r_object_type');
		    $type = r_get_type($type_key);
		    return $type['label'];
	    }

	    if (r_is_action_page('single')) {
			$entry = r_get_response();
			if (isset($entry['title']) && $entry['title']) {
				return $entry['title'];
			}
	    }

	    return __('Bibliography', 'rownosc');

    }

    function is_supported_type($type)
    {
    	$supported_types = array(
    		'publication',
		    'article',
		    'document',
		    'journal',
		    'multimedium',
		    'research',
		    'studies'
	    );
        return in_array($type, $supported_types);
    }

    public function get_prefix_permastruct()
    {
        global $wp_rewrite;

        $page_struct = $wp_rewrite->get_page_permastruct();
        $page_name = get_page_uri(r_get_option('endpoint_page'));

        return str_replace('%pagename%', $page_name, $page_struct);

    }

    public function get_index_permastruct()
    {
        $prefix = $this->get_prefix_permastruct();
        return $prefix . '/%r_object_type%/';
    }

    public function get_show_permastruct()
    {
        $prefix = $this->get_prefix_permastruct();
        return $prefix . '/%r_object_type%/%r_object_id%/%r_object_slug%/';
    }
}