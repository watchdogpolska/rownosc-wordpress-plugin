
<?php
$entry = r_get_response();
?>

<div class="r-single-item">
    <div class="r-single-item__cover">
        <img src="<?= $entry['cover'];?>" alt="<?= $entry['title'];?>">
    </div>
    <h1><?= $entry['title'];?></h1>

    <?php if(isset($entry['author'])):?>
        <p>
            <?php if (count($entry['author']) == 0) {?>
            <?php }else if(count($entry['author']) == 1) {
                echo "Autor/-ka: ";
                echo $entry['author'][0]['name'];
            } else {
                echo "Autorzy: ";
                foreach($entry['author'] as $author) {
                    echo $author['name'] .' ';
                }
            }
            ?>
        </p>

    <?php
    endif;?>
    <p>
		<?php
		if(count($entry['publisher_org']) == 0){?>
		<?php }else if(count($entry['publisher_org']) == 1) {
			echo "Wydawca: ";
			echo $entry['publisher_org'][0]['title'];
		} else {
			echo "Wydawcy: ";
			foreach($entry['publisher_org'] as $author) {
				echo $author['title'] .' ';
			}
		}
		?>
    </p>
    <p><?= $entry['place'];?>, <?= $entry['year'];?></p>
	<?php if ($entry['isbn']): ?>
        <p>ISBN: <?= $entry['isbn'];?></p>
	<?php endif;?>
	<?php if ($entry['pages']): ?>
        <p>Liczba stron: <?= $entry['pages'];?></p>
	<?php endif;?>
	<?php if ($entry['publication_url']): ?>
        <p>Link do publikacji: <a href="<?= $entry['publication_url'];?>"><?= $entry['publication_url_desc'];?></a></p>
	<?php endif;?>
    <?= $entry['description'];?>

    <?php r_get_template_part('parts/download.php');?>
</div>