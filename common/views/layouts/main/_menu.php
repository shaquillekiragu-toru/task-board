<li>
	<?php if (isset($entry['blank']) && $entry['blank']) { ?>
		<div class='h-1 m-0 my-2 p-0 bg-base-200 opacity-50'></div>
	<?php } else { ?>
		<a href='<?= $entry['url'] ?? '#' ?>' class='<?= $entry['active'] ? 'active' : '' ?>'>
			<?= $entry['label'] ?>
		</a>
		<?php if (isset($entry['children']) && count($entry['children']) > 0) { ?>
			<ul class="p-2 bg-base-100 shadow-xl">
				<?php foreach ($entry['children'] as $child) { ?>
					<li>
						<?= $this->render('./_menu.php', ['entry' => $child]) ?>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
	<?php } ?>
</li>
