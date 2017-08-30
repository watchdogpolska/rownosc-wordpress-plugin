<?php
namespace Rownosc;

class FrontentScripts{

	/**
	 * Hook in methods.
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
	}

	public static function load_scripts() {
		wp_enqueue_style('rownosc', R_PLUGIN_URL . '/assets/rownosc.css', R_VERSION);
	}
}