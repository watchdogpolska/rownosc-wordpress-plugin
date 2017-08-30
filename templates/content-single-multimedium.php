
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
	<?php if(isset($entry['country'])):?>
        <p>
			<?php if(count($entry['country']) == 0) {?>
			<?php }else if(count($entry['country']) == 1) {
				echo "Kraj: " . $entry['country'][0]['name'];
			} else {
				echo "Kraje: ";
				foreach($entry['country'] as $subentry) {
					echo $subentry['name'] .' ';
				}
			}
			?>
        </p>
		<?php
	endif;?>
	<?php if ($entry['year']): ?>
        <p>Rok: <?= $entry['year'];?></p>
	<?php endif;?>
	<?php if ($entry['length']): ?>
        <p>Długość: <?= $entry['length'];?></p>
	<?php endif;?>
	<?php if ($entry['multimedium_url']): ?>
        <p>Link do publikacji: <a href="<?= $entry['multimedium_url'];?>"><?= $entry['multimedium_url_desc'];?></a></p>
	<?php endif;?>
    <?= $entry['description'];?>

	<?php get_template_part('parts/download.php');?>
</div>