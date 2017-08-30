<?php

namespace Rownosc;

class Options {
    const OPTION_KEY = "r_options";



    static function get($key)
    {
        $options = get_option('r_options', array());
        $options = array_merge(self::get_default_values(), $options);

        return isset($options[$key]) ? $options[$key] : null;
    }

    static function set($key, $value)
    {
        $options = get_option('r_options');
        $options['key'] = $value;
        update_option($key, $value, true);
    }

	static function get_default_values() {
    	return array(
		    'endpoint_page' => -1,
		    'token' => '',
		    'base_path' => 'http://rownosc.info/api/v1/',
	    );
	}
}