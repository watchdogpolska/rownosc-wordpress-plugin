<?php


function r_get_response() {
    return R()->query->response;
}

function r_link_index($type) {
    global $wp_rewrite;
    if ($wp_rewrite->using_permalinks())
    {
        $permastruct = R()->endpoints->get_index_permastruct();
        $link = str_replace('%r_object_type%', $type, $permastruct);
        return home_url($link);
    }

    $page_url = get_page_link(r_get_option('endpoint_page'));
    return add_query_arg('r_object_type', $type, $page_url);
}

function r_get_link_show($object = null)
{
    if ($object == null) {
        $object = r_get_response();
    }

    $endpoint_link = get_page_link(r_get_option('endpoint_page'));;

    if (!isset($object['id']) || !isset($object['_type']) || !isset($object['slug'])){
        return $endpoint_link;
    }

    global $wp_rewrite;
    if ($wp_rewrite->using_permalinks()) {
        $permastruct = R()->endpoints->get_show_permastruct();
        $path = str_replace('%r_object_type%', $object['_type'], $permastruct);
        $path = str_replace('%r_object_id%', $object['id'], $path);
        $path = str_replace('%r_object_slug%', $object['slug'], $path);
        $link = home_url($path);
    } else {
        $link = add_query_arg(array(
        	'r_object_action' => 'single',
            'r_object_type' => $object['_type'],
            'r_object_id' => $object['id'],
            'r_object_slug' => $object['slug']
        ), $endpoint_link);
    }

    return $link;
}

function r_link_pagenum_index($type = null, $page) {
    global $wp_rewrite;

    $type = $type == null ? get_query_var('r_object_type') : $type;

    if ($wp_rewrite->using_permalinks()) {
        $link = r_link_index($type);
        return $link . $wp_rewrite->pagination_base . '/' . $page;
    } else {
        return add_query_arg('paged', $page, r_link_index($type));
    }
}

function r_search_url() {
	global $wp_rewrite;

	$root = get_page_link(r_get_option('endpoint_page'));
	if ($wp_rewrite->using_permalinks()) {
		return trailingslashit($root) . 'search/' ;
	} else {
		return add_query_arg('r_action', 'search', $root);
	}
}

function r_get_endpoint_title() {
    return R()->endpoints->get_endpoint_title();
}

function r_the_get_endpoint_title() {
    echo r_get_endpoint_title();
}


function r_get_the_description($entry = null) {
	if ($entry == null) {
		$entry = r_get_response();
	}

	if ( !isset($entry['description']) ) {
		return '';
	}
    $description = $entry['description'];
    return apply_filters('r_get_the_description', $description);
}

function r_get_the_description_trim_words($text) {
    return wp_trim_words($text, 50);
}

add_filter('r_get_the_description', 'r_get_the_description_trim_words');

function r_get_the_description_strip_tags($text) {
    return strip_tags($text);
}

add_filter('r_get_the_description', 'r_get_the_description_strip_tags');

function rownosc_output_content_wrapper() {
	r_get_template( 'global/wrapper-start.php' );
}

function rownosc_output_content_wrapper_end() {
	r_get_template( 'global/wrapper-end.php' );
}

function rownosc_get_sidebar() {
	r_get_template( 'global/sidebar.php' );
}

function r_get_search_form( $echo = true ) {
	/**
	 * Fires before the search form is retrieved, at the start of get_search_form().
	 *
	 * @since 2.7.0 as 'get_search_form' action.
	 * @since 3.6.0
	 *
	 * @link https://core.trac.wordpress.org/ticket/19321
	 */
	do_action( 'pre_get_search_form' );

	$search_form_template = r_locate_template( 'searchform.php' );
	ob_start();
	require( $search_form_template );
	$form = ob_get_clean();

	if ($echo) {
		echo $form;
	} else {
		return $form;
	}
}