<?php
$entry = r_get_response();
?>
<p>

	<?php if (isset($entry['attachment']) && count($entry['attachment'])): ?>
	<h2>Do pobrania</h2>
	<ul>
		<?php foreach($entry['attachment'] as $author): ?>
			<li>
				<a href="<?= $author['att'];?>"><?= $author['name'];?></a>
			</li>
			<?php
		endforeach;
		?>
	</ul>
	<?php endif;?>
</p>