<?php

/**
 * Replace a page title with the endpoint title.
 * @param  string $title
 * @return string
 */
function r_page_endpoint_title( $title ) {
    global $wp_query;

    if ( ! is_null( $wp_query ) && ! is_admin() && is_main_query() && in_the_loop() && is_rownosc() ) {

        if ( $endpoint_title = R()->endpoints->get_endpoint_title( ) ) {
            $title = $endpoint_title;
        }

        remove_filter( 'the_title', 'wc_page_endpoint_title' );
    }

    return $title;
}

add_filter( 'the_title', 'r_page_endpoint_title' );

function r_document_title_parts($parts) {
    if (!is_rownosc()) {
        return $parts;
    }

    $parts['title'] = R()->endpoints->get_endpoint_title( );

    return $parts;
}
add_filter( 'document_title_parts', 'r_document_title_parts');

function is_rownosc() {
    return is_page( r_get_option('endpoint_page', -1) );
}

/**
 * is_r_dynamic_url - Check if an dynamic endpoint is showing.

 * @return bool
 */
function is_r_dynamic_url( ) {
	return get_query_var('r_action') != '';
}

/**
 * @param $action_name
 */
function r_is_action_page($action_name) {
	if(!is_r_dynamic_url()){
		return false;
	}
	return get_query_var('r_action') == $action_name;
}
/**
 * is_r_list_url - Check if an endpoint type is showing.

 * @return bool
 */
function is_r_type_url( ) {
    return get_query_var('r_action') == 'archive';
}

/**
 * is_r_list_url - Check if an endpoint list is showing.

 * @return bool
 */
function is_r_object_url( ) {
	return get_query_var('r_action') == 'single';
}

/**
 * Retrieve options .
 *
 * @param string $key
 * @return int
 */
function r_get_option( $key , $default = '') {
    return \Rownosc\Options::get($key);
}


function r_cache_get($key) {
    return R()->cache->get($key);
}

function r_cache_set($key, $value, $expiration = WEEK_IN_SECONDS) {
    R()->cache->set($key, $value, $expiration);
}

