
<?php
$entry = r_get_response();
?>

<div class="r-single-item">
    <div class="r-single-item__cover">
        <img src="<?= $entry['cover'];?>" alt="<?= $entry['title'];?>">
    </div>
    <h1><?= $entry['title'];?></h1>

    <?php if(isset($entry['researcher'])):?>
        <p>
            <?php if(count($entry['researcher']) == 0){?>
            <?php }else if(count($entry['researcher']) == 1) {
                echo "Autor/-ka: ";
                echo $entry['researcher'][0]['name'];
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


    <p>Rok: <?= $entry['year'];?></p>
	<?php if(isset($entry['range'])):?>
        <p>
            Zakres: <?= $entry['range']['name']; ?>
        </p>
		<?php
	endif;?>
	<?php if(isset($entry['genre_document'])):?>
        <p>
            Rodzaj dokuementu: <?= $entry['genre_document']['name']; ?>
        </p>
		<?php
	endif;?>
	<?php if(isset($entry['genre_document'])):?>
        <p>
            Rodzaj danych: <?= $entry['genre_data']['name']; ?>
        </p>
		<?php
	endif;?>
	<?php if(isset($entry['genre_research'])):?>
        <p>
            Rodzaj badania: <?= $entry['genre_research']['name']; ?>
        </p>
		<?php
	endif;?>

    <?php if ($entry['isbn']): ?>
        <p>ISBN: <?= $entry['isbn'];?></p>
	<?php endif;?>
	<?php if ($entry['publication_url']): ?>
        <p>Link do publikacji: <a href="<?= $entry['publication_url'];?>"><?= $entry['publication_url_desc'];?></a></p>
	<?php endif;?>
    <?= $entry['description'];?>

	<?php r_get_template_part('parts/download');?>
</div>