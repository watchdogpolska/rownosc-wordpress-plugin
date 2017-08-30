<?php

namespace Rownosc;

class Cache {

    function __construct()
    {
        wp_cache_add_global_groups(array( R_CACHE_GROUP ));
    }

    function get($key) {
        return wp_cache_get($key, R_CACHE_GROUP);
    }

    function set($key, $value, $expiration = WEEK_IN_SECONDS){
        wp_cache_set($key, $value, R_CACHE_GROUP, WEEK_IN_SECONDS);
    }
}