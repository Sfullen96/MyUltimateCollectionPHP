<div class="row">
	<div class="col-xs-12 col-sm-6">
		<h4 class="text-center"> Upcoming Gigs for <?= $artist[0]->artist_name; ?> </h4>

	</div>
	<div class="col-xs-12 col-sm-6">
		<h4 class="text-center"> Attended a gig(s) for <?= $artist[0]->artist_name ?>? </h4>
		<?php if($gigs_attended_count > 0) { ?>
			<?php foreach ($attended_gigs as $gigs) { ?>
				
			<?php } ?>
		<?php } else { ?>

		<?php } ?>
	</div>
</div>

<div class="row">
	<?php $count = 0; ?>
	<?php foreach($albums as $album) { ?>
		<div class="col-xs-6 col-sm-3">
			<a href="/item/<?= $album->item_id; ?>">
				<div class="albumPreview" style="background-image: url('');background-size: cover">
					<img src="<?= ($album->album_image?$album->album_image:base_url() . 'images/default.png'); ?>" class="img-responsive">
				</div>
			</a>
		</div>
	<?php $count++; ?>
	<?php } ?>
</div>