<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 28.08.17
 * Time: 16:51
 */
/**
 * Get template part (for templates like the shop-loop).
 *
 * WC_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 */
function r_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/rownosc/slug-name.php
	if ( $name ) {
		$template = locate_template( array( "{$slug}-{$name}.php", R()->template_path() . "{$slug}-{$name}.php" ) );
	}

	// Get default slug-name.php
	if ( ! $template && $name && file_exists( R()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
		$template = R()->plugin_path() . "/templates/{$slug}-{$name}.php";
	}


	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/rownosc/slug.php
	if ( ! $template ) {
		$template = locate_template( array( "{$slug}.php", R()->template_path() . "{$slug}.php" ) );
	}

	// Get default slug.php
	if ( ! $template && file_exists( R()->plugin_path() . "/templates/{$slug}.php" ) ) {
		$template = R()->plugin_path() . "/templates/{$slug}.php";
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'r_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 */
function r_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}

	$located = r_locate_template( $template_name, $template_path, $default_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'woocommerce' ), '<code>' . $located . '</code>' ), '2.1' );
		return;
	}

	// Allow 3rd party plugin filter template file from their plugin.
	$located = apply_filters( 'r_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'rownosc_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'rownosc_after_template_part', $template_name, $template_path, $located, $args );
}


/**
 * Like wc_get_template, but returns the HTML instead of outputting.
 *
 * @see wc_get_template
 * @since 2.5.0
 * @param string $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 *
 * @return string
 */
function r_get_template_html( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	ob_start();
	r_get_template( $template_name, $args, $template_path, $default_path );
	return ob_get_clean();
}
/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function r_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = R()->template_path();
	}

	if ( ! $default_path ) {
		$default_path = R()->plugin_path() . '/templates/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	// Get default template/
	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return apply_filters( 'rownosc_locate_template', $template, $template_name, $template_path );
}


/**
 * Retrieves the contents of the search Rownosc query variable.
 *
 * The search query string is passed through esc_attr() to ensure that it is safe
 * for placing in an html attribute.
 *
 *
 * @param bool $escaped Whether the result is escaped. Default true.
 *                         Only use when you are later escaping it. Do not use unescaped.
 * @return string
 */
function r_get_search_query( $escaped = true ) {
	/**
	 * Filters the contents of the search query variable.
	 *
	 * @param mixed $search Contents of the search query variable.
	 */
	$query = apply_filters( 'get_search_query', get_query_var( 'r_q' ) );

	if ( $escaped )
		$query = esc_attr( $query );
	return trim($query);
}