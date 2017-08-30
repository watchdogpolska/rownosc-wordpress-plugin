<?php

namespace Rownosc;

class TemplateLoader
{

    static function init()
    {
        add_filter( 'template_include', array( __CLASS__, 'template_loader' ) );
    }

    static function template_loader($template) {
        if ( $default_file = self::get_default_file() ) {
            $files = self::get_files($default_file);
            $template = locate_template($files);

            if (!$template) {
                $template = R_PLUGIN_PATH . 'templates/' . $default_file;
            }
        }
        return $template;
    }

    static function get_default_file() {
        $defualt_file = '';
        if ( is_rownosc() ) {
        	if (get_query_var('r_action') == 'search') {
		        $defualt_file = 'search.php';
	        } else if ( r_is_action_page('archive') ) {
                $defualt_file = 'archive.php';
            } else if ( r_is_action_page('single') ) {
                $defualt_file = 'single.php';
            } else {
                $defualt_file = 'root.php';
            };
        }

        return $defualt_file;
    }

    static function get_files($default_file) {
	    $search_files = array();
        $search_files[] = 'rownosc.php';

        $search_files[] = R()->template_path() . 'rownosc.php';
        $search_files[] = R()->template_path() . $default_file;

        return array_unique($search_files);
    }
}