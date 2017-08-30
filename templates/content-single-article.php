
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

    <?php if(isset($entry['author'])):?>
	    <?php if ($entry['journal_object']): ?>
            <p>Czasopismo: <?= $entry['journal_object']['name'];?></p>
	    <?php endif;?>
	    <?php if ($entry['publication_url']): ?>
            <p><a href="<?= $entry['publication_url'];?>"><?= $entry['publication_url_desc'];?></a></p>
	    <?php endif;?>
        <?php
    endif;?>
    <?= $entry['description'];?>

	<?php get_template_part('parts/download.php');?>
</div>