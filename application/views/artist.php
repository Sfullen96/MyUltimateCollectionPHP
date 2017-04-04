<div class="row">
	<div class="col-xs-12 col-sm-6">
		<h4 class="text-center"> Upcoming Gigs for <?= $artist[0]->artist_name; ?> </h4>
	</div>
	<div class="col-xs-12 col-sm-6">
		<h4 class="text-center attendedGigsHeader"> Attended a gig(s) for <?= $artist[0]->artist_name ?>? </h4>
		<?php if($gigs_attended_count > 0) { ?>
		<?php foreach ($gigs_attended as $gig) { ?>
			<p> <?= $artist[0]->artist_name; ?> at <?= ($gig->gig_venue?$gig->gig_venue.', ':'unknown venue'); ?><?= ($gig->gig_city?$gig->gig_city.', ':''); ?><?= ($gig->gig_country?$gig->gig_country:''); ?> on <?= ($gig->gig_date?date('d/m/Y', strtotime($gig->gig_date)):'unknown date'); ?></p>
			<small class="margin-bottom"> <a href="/setlist/<?= $gig->gig_id; ?>"> View Setlist </a> </small>
		<?php } ?>
		<?php } else { ?>
		<form action="/gig/addGig" method="POST">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="date" class="gigDate form-control margin-bottom" id="datepicker" placeholder="Gig Date">
				</div>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="tour" disabled title="Please choose a date first" class="form-control margin-bottom" placeholder="Tour Name">
				</div>
			</div>
			<div class="row appendMe">
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="venue" disabled title="Please choose a date first" class="form-control margin-bottom" placeholder="Venue Name">
				</div>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="city" disabled title="Please choose a date first" class="form-control margin-bottom" placeholder="Venue City">
				</div>
			</div>
			<input type="hidden" name="country" value="UK">
			<input type="hidden" name="artistName" id="artistName" value="<?= $artist[0]->artist_name; ?>">
			<input type="hidden" name="artist_id" value="<?= $artist[0]->artist_id; ?>">
			<input type="submit" class="btn btn-primary" name="submit" value="Add Gig">
		</form>
		<?php } ?>
	</div>
</div>
<div class="row">
	<?php $count = 0; ?>
	<?php foreach($albums as $album) { ?>
	<div class="col-xs-6 col-sm-3">
		<a href="/item/<?= $album->item_id; ?>">
			<div class="albumPreview" style="background-image: url('');background-size: cover">
				<div class="overlay">
					<h4> <?= $album->title; ?> </h4>
				</div>
				<img src="<?= ($album->album_image?$album->album_image:base_url() . 'images/default.png'); ?>" class="img-responsive">
			</div>
		</a>
	</div>
	<?php $count++; ?>
	<?php } ?>
</div>