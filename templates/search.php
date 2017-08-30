<?php
get_header('rownosc');

/**
 * rownosc_before_main_content hook.
 *
 * @hooked rownosc_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'rownosc_before_main_content' );
?>

<h1>Wyniki wyszukiwań</h1>
<?php r_get_search_form();?>

<?php //var_dump(r_get_response());?>
<?php
foreach(r_get_response() as $entry) {
	?>
    <div class="r-archive-item">
		<?php if(isset($entry['object']['cover']) && $entry['object']['cover']):?>
            <div class="r-archive-item__cover">
                <img src="http://rownosc.info/media/<?= $entry['object']['cover'];?>" alt="<?= $entry['object']['title'];?>">
            </div>
		<?php endif;?>
        <div class="r-archive-item__content">
            <h2>
                <?php
                $fake = array(
                    'id' => explode('/', $entry['api_detail'], -1)[7],
                    'slug' => explode('/', $entry['object']['get_absolute_url'])[3],
                    '_type' => $entry['model_name']
                );
                ?>
                <a href="<?= r_get_link_show($fake);?>">
					<?= $entry['object']['title'];?>
                </a>
            </h2>
			<?php
			echo r_get_the_description($entry['object']);
			?>
        </div>
    </div>
	<?php
}
?>

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
