<?php
get_header('rownosc');

/**
 * rownosc_before_main_content hook.
 *
 * @hooked rownosc_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'rownosc_before_main_content' );
?>
<h1><?php r_the_get_endpoint_title(); ?></h1>


<?php
global $entry;

foreach(r_get_response() as $entry):
?>
    <div class="r-archive-item">
		<?php if(isset($entry['cover']) && $entry['cover']):?>
            <div class="r-archive-item__cover">
                <img src="<?= $entry['cover'];?>" alt="<?= $entry['title'];?>">
            </div>
		<?php endif;?>
        <div class="r-archive-item__content">
            <h2>
                <a href="<?= r_get_link_show($entry);?>">
					<?= $entry['title'];?>
                </a>
            </h2>
			<?php
			echo r_get_the_description($entry);
			?>
        </div>
    </div>
<?php
endforeach;
?>

<div class="pager">
    <?php
    $big = 99999;
    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( r_link_pagenum_index( null, $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => R()->query->max_num_pages
    ) );
    ?>
</div><!-- .tablenav -->

<?php
/**
 * rownosc_after_main_content hook.
 *
 * @hooked rownosc_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'rownosc_after_main_content' );
?>

<?php
/**
 * rownosc_sidebar hook.
 *
 * @hooked rownosc_get_sidebar - 10
 */
do_action( 'rownosc_sidebar' );

get_footer('rownosc');
?>
