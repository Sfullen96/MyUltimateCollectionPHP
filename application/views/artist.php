<!-- <div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> <?= ucwords($artist[0]->artist_name); ?> </h2>
	</div>
</div> -->
<div class="row margin-bottom">
	<div class="col-xs-12 col-sm-4">
		<img src="<?= ($artist[0]->artist_image > ''?$artist[0]->artist_image:base_url().'images/default.png'); ?>" class="img-responsive albumImage">
	</div>
	<div class="col-xs-12 col-sm-8 ratingContainer">
		<div class="albumInfo">
			<h2 class="albumTitle text-center-mobile"> <?= ucwords($artist[0]->artist_name) ?> </h2>
			<p class="albumSummary margin-bottom" id="summary">
				<?= (isset($artist[0]->artist_summary)?trim($artist[0]->artist_summary) . '<br>
                <a href="/editSummary/'. $artist[0]->artist_id .'" class="text-center-mobile"> Edit this Summary </a>'
                :
                'No summary found. <a href="/addSummary/'. $artist[0]->artist_id .'" class="text-center-mobile"> Add Your Own </a>'); ?>
			</p>
		</div>
	</div>
</div>

<?php if ( !count( $tags ) ) { ?>
<div class="row">
	<div class="moreInfoBanner col-xs-12 tags">
		<div class="row">
            <?php if ($tags) { ?>
                <?php foreach ($tags as $tag) { ?>
                    <div class="col-xs-12 col-sm-3">
                        <p> <i class="fa fa-tags"></i> <a href="<?= $tag->tag_url ?>" target="_blank"> <?= ucwords($tag->tag_name) ?></a> </p>
                    </div>
                <?php } ?>
            <?php } ?>
		</div>
	</div>
</div>
<?php } ?>
<div class="row margin-bottom">
	<!-- <div class="col-xs-12 col-sm-6">
		<h4 class="text-center"> Upcoming Gigs for <?= ucwords($artist[0]->artist_name); ?> </h4>
	</div> -->
	<div class="col-sm-2"></div>
	<div class="col-xs-12 col-sm-8 attendedGigs">
		<?php if($gigs_attended_count > 0) { ?>
		<h4 class="text-center attendedGigsHeader"> Gigs Attended for <?= ucwords($artist[0]->artist_name) ?> </h4>
		<?php foreach ($gigs_attended as $gig) { ?>
		<h6> <?= (isset($gig->gig_tour)?'' . $gig->gig_tour:''); ?> </h6>
		<p> <?= ucwords($artist[0]->artist_name); ?> at <?= ($gig->gig_venue?$gig->gig_venue.', ':'unknown venue'); ?><?= ($gig->gig_city?$gig->gig_city.', ':''); ?><?= ($gig->gig_country?$gig->gig_country:''); ?> on <?= ($gig->gig_date?date('d/m/Y', strtotime($gig->gig_date)):'unknown date'); ?></p>
		<?php if($gig->setlistId) { ?>
		<small class="margin-bottom"> <a href="/setlist/<?= $gig->setlistId; ?>"> View Setlist </a> </small><br><br>
		<?php } else { ?>
		<small class="margin-bottom"> <a href="/setlist/<?= $gig->gig_id; ?>"> Add a Setlist for this Gig </a> </small><br><br>
		<?php } ?>
		<?php } ?>
		<h4 class="margin-bottom"> Add Another Gig </h4>
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
			<input type="hidden" name="setlist_id">
			<input type="hidden" name="country" value="UK">
			<input type="hidden" name="artistName" id="artistName" value="<?= ucwords($artist[0]->artist_name); ?>">
			<input type="hidden" name="artist_id" value="<?= $artist[0]->artist_id; ?>">
			<input type="submit" class="btn btn-primary" name="submit" value="Add Gig">
		</form>
		<?php } else { ?>
		<h4 class="text-center attendedGigsHeader"> Add a Gig for <?= ucwords($artist[0]->artist_name) ?>? </h4>
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
			<input type="hidden" name="setlist_id">
			<input type="hidden" name="country" value="UK">
			<input type="hidden" name="artistName" id="artistName" value="<?= ucwords($artist[0]->artist_name); ?>">
			<input type="hidden" name="artist_id" value="<?= $artist[0]->artist_id; ?>">
			<input type="submit" class="btn btn-primary" name="submit" value="Add Gig">
		</form>
		<?php } ?>
	</div>
	<div class="col-sm-2"></div>
</div>
<hr>
<h4> Albums you own for this artist: </h4>
<div class="row">
	<?php $count = 0; ?>
	<?php foreach($albums as $album) { ?>
	<div class="col-xs-12 col-sm-3">
		<a href="/item/<?= $album->item_id; ?>">
			<div class="albumPreview" style="background-image: url('');background-size: cover">
				<div class="overlay">
					<h4> <?= ucwords($album->title); ?> </h4>
				</div>
				<img src="<?= ($album->image?$album->image:base_url() . 'images/default.png'); ?>" class="img-responsive">
			</div>
		</a>
	</div>
	<?php $count++; ?>
	<?php } ?>
</div>