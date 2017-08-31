<?php

namespace Rownosc;

class Rownosc {

    private static $_instance;

    /**
     * @var Rewrite
     */
    public $endpoints;

    /**
     * @var Cache
     */
    public $cache;

    /**
     * @var Query
     */
    public $query;

    /**
     * Rownosc constructor.
     */
    function __construct()
    {
        $this->constants();

        $this->endpoints = new Rewrite();
        $this->cache = new Cache();
        $this->query = new Query();

        $this->init();
    }

    function init() {
    	$this->load_textdomain();
        $install= new Install();
        $template_loader = new TemplateLoader();
        $frontent_script = new FrontentScripts();

        $install->init();
        $template_loader->init();
		$frontent_script->init();

        $this->query->init();

        if ( is_admin() ) {
            $option_page = new OptionPage();
            $option_page->init();
        }
    }

	function load_textdomain() {
		load_plugin_textdomain( 'rownosc', false, 'rownosc/languages/' );
	}

    function constants() {
        define( 'R_CACHE_GROUP', 'rownosc' );
    }

    /**
     * Get the template path.
     * @return string
     */
    public function template_path() {
        return apply_filters( 'rownosc_template_path', '/rownosc/' );
    }


	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) . '/../' );
	}

	/**
     * Main Rownosc Instance.
     *
     * Ensures only one instance of Rownosc is loaded or can be loaded.
     *
     * @since 2.1
     * @static
     * @see R()
     * @return Rownosc - Main instance.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}