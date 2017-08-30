
<?php
$entry = r_get_response();
?>

<div class="r-single-item">
	<?php if(isset($entry['cover']) && $entry['cover']): ?>
        <div class="r-single-item__cover">
            <img src="<?= $entry['cover'];?>" alt="<?= $entry['title'];?>">
        </div>
	<?php endif;?>
    <h1><?= $entry['title'];?></h1>

<!--	--><?php //if ($entry['frequency']): ?>
<!--        <p>Częstotliwość: --><?//= $entry['frequency'];?><!--</p>-->
<!--	--><?php //endif;?>
	<?php if ($entry['year']): ?>
        <p>Rok pierwszego wydania: <?= $entry['year'];?></p>
	<?php endif;?>
	<?php if ($entry['publication_url']): ?>
        <p>Link do dokumentu: <a href="<?= $entry['publication_url'];?>"><?= $entry['publication_url_desc'];?></a></p>
	<?php endif;?>

    <?= $entry['description'];?>

	<?php get_template_part('parts/download.php');?>
</div>