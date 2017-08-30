<?php
get_header('rownosc');

/**
 * rownosc_before_main_content hook.
 *
 * @hooked rownosc_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'rownosc_before_main_content' );
?>

<?php
$entry = r_get_response();
?>

<?php r_get_template_part('content-single', $entry['_type']);?>

<?php
/**
 * rownosc_after_main_content hook.
 *
 * @hooked rownosc_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'rownosc_after_main_content' );

/**
 * rownosc_sidebar hook.
 *
 * @hooked rownosc_get_sidebar - 10
 */
do_action( 'rownosc_sidebar' );

get_footer('rownosc');
?>
