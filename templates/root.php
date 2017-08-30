<?php
get_header('rownosc');

/**
 * rownosc_before_main_content hook.
 *
 * @hooked rownosc_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'rownosc_before_main_content' );
?>

<h1><?= r_get_endpoint_title();?></h1>
<?php r_get_search_form();?>
<ul class="library-list">
    <li>
        <a href="<?= esc_url(r_link_index('publication'));?>">Publikacje</a>
    </li>
    <li>
        <a href="<?= esc_url(r_link_index('article'));?>">Publikacje prasowe</a>
    </li>
    <li>
        <a href="<?= esc_url(r_link_index('document'));?>">Akty prawne / dokumenty</a>
    </li>
    <li>
        <a href="<?= esc_url(r_link_index('journal'));?>">Czasopisma</a>
    </li>
    <li>
        <a href="<?= esc_url(r_link_index('multimedium'));?>">Media</a>
    </li>
    <li>
        <a href="<?= esc_url(r_link_index('research'));?>">Badania i statystyki</a>
    </li>
</ul>

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
