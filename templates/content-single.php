
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
    <?= $entry['description'];?>
    <p>
		<?php if (count($entry['attachment']) != 0){
			echo "<h2>Do pobrania</h2>";
			echo "<ul>";
			foreach($entry['attachment'] as $author) {
				?>
                <a href="<?= $author['att'];?>"><?= $author['name'];?></a>
				<?php
			}
			echo "</ul>";
		}
		?>
    </p>
</div>