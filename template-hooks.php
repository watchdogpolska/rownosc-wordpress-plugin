<?php
/**
 * Content Wrappers.
 *
 * @see rownosc_output_content_wrapper()
 * @see rownosc_output_content_wrapper_end()
 */
add_action( 'rownosc_before_main_content', 'rownosc_output_content_wrapper', 10 );
add_action( 'rownosc_after_main_content', 'rownosc_output_content_wrapper_end', 10 );


/**
 * Sidebars
 *
 * @see rownosc_get_sidebar()
 */
add_action( 'rownosc_sidebar', 'rownosc_get_sidebar', 10 );