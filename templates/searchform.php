<?php
$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';

/**
 * Filters the HTML format of the search form.
 *
 * @since 3.6.0
 *
 * @param string $format The type of markup to use in the search form.
 *                       Accepts 'html5', 'xhtml'.
 */
$format = apply_filters( 'search_form_format', $format );
if ( 'html5' == $format ):
	?>
	<form role="search" method="get" class="search-form" action="<?= esc_url( r_search_url() ) ?>">
        <label>
            <span class="screen-reader-text"><?php __( 'Search for:', 'label' );?></span>
            <input type="search" class="search-field" placeholder="<?= esc_attr_x( 'Search &hellip;', 'placeholder' );?>" value="<?= r_get_search_query(); ?>" name="r_q" />
        </label>
        <input type="submit" class="search-submit" value="<?= esc_attr_x( 'Search', 'submit button' ); ?>" />
    </form>
<?php else: ?>
	<form role="search" method="get" id="searchform" class="searchform" action="<?= esc_url( r_search_url() ); ?>'">
	    <div>
	        <label class="screen-reader-text" for="r_q"><?= _x( 'Search for:', 'label' ); ?></label>
	        <input type="text" value="<?= r_get_search_query() ?>" name="r_q" id="r_q" />
	        <input type="submit" id="searchsubmit" value="<?= esc_attr_x( 'Search', 'submit button' ); ?>" />
	    </div>
	</form>
<?php
endif;