<div class="row">
	<div class="col-xs-12 col-sm-6">
		<div class="row">
			<div class="artistBanner margin-bottom col-xs-12 text-center">
				<h2> <i class="fa fa-music"></i> Recently Added </h2>
			</div>
		</div>
		<div class="row">
			<div id="recentlyAddedCarousel" class="carousel slide" data-ride="carousel" data-interval="11000" data-pause="false">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php $counter = 0; ?>
					<?php foreach ($recently_added as $item) { ?>
						<li data-target="#recentlyAddedCarousel" data-slide-to="<?= $counter ?>" class="<?= ($counter == 0?'active':'') ?>"></li>
						<?php $counter++; ?>
					<?php } ?>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php $counter = 0; ?>
					<?php foreach ($recently_added as $item) { ?>
					<div class="item <?= ($counter == 0?'active':'') ?> homeCarItem">
						<a href="/item/<?= $item->item_id ?>"><img src="<?= ($item->album_image?$item->album_image:base_url() . 'images/default.png'); ?>" class="img-responsive"></a>
						<h3> <a href="/item/<?= $item->item_id ?>"><?= $item->title; ?></a> by <a href="/artist/<?= $item->artist_id ?>"><?= $item->artist_name ?></a> </h3>
						<h5> Added: <?= date('d/m/Y', strtotime($item->created_at)) ?> </h5>
					</div>
					<?php $counter++; ?>
					<?php } ?>
				</div>
				<!-- Left and right controls -->
				<!-- <a class="left carousel-control" href="#recentlyAddedCarousel" role="button" data-slide="prev">
								<span class="glyphicon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#recentlyAddedCarousel" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
				</a> -->
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="row">
			<div class="artistBanner margin-bottom col-xs-12 text-center">
				<h2> <i class="fa fa-headphones"></i> Recently Viewed </h2>
			</div>
		</div>
		<div class="row">
			<div id="recentlyViewedCarousel" class="carousel slide" data-ride="carousel" data-interval="10000" data-pause="false">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php $counter = 0; ?>
					<?php if($recently_viewed) { ?>
					<?php foreach ($recently_viewed as $item) { ?>
						<li data-target="#recentlyViewedCarousel" data-slide-to="<?= $counter ?>" class="<?= ($counter == 0?'active':'') ?>"></li>
						<?php $counter++; ?>
					<?php } ?>
					<?php } ?>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php $counter = 0; ?>
					<?php if($recently_viewed) { ?>
					<?php foreach ($recently_viewed as $item) { ?>
					<div class="item <?= ($counter == 0?'active':'') ?> homeCarItem">
						<a href="/item/<?= $item->item_id ?>"><img src="<?= ($item->album_image?$item->album_image:base_url() . 'images/default.png'); ?>" class="img-responsive"></a>
						<h3> <a href="/item/<?= $item->item_id ?>"><?= $item->title; ?></a> by <a href="/artist/<?= $item->artist_id ?>"><?= $item->artist_name ?></a> </h3>
						<h5> Viewed: <?= date('d/m/Y H:i:s', strtotime($item->timestamp)) ?> </h5>
					</div>
					<?php $counter++; ?>
					<?php } ?>
					<?php } else { ?>
					<h4 class="margin-bottom text-center"> No items viewed yet </h4>
					<?php } ?>
				</div>
				<!-- Left and right controls -->
				<!-- <a class="left carousel-control" href="#recentlyViewedCarousel" role="button" data-slide="prev">
							<span class="glyphicon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#recentlyViewedCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
				</a> -->
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> Stats </h2>
	</div>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> CD's added this week: </td>
			<td> <?= $cd_week; ?> </td>
		</tr>
		<tr>
			<td> CD's added this month: </td>
			<td> <?= $cd_month; ?> </td>
		</tr>
		<tr>
			<td> CD's added this year: </td>
			<td> <?= $cd_year; ?> </td>
		</tr>
		<tr>
			<td> CD's Listened to: </td>
			<td> <?= $cd_listened_count; ?>/<?= $cd_count; ?> </td>
		</tr>
	</tbody>
</table>
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> Favourite Albums </h2>
	</div>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php if($favourite_albums) { ?>
		<?php foreach ($favourite_albums as $album) { ?>
		<tr>
			<td> <?= $album->title; ?> </td>
			<td> Viewed <?= $album->views ?> times </td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<h4 class="margin-bottom text-center"> No items viewed yet </h4>
		<?php } ?>
	</tbody>
</table>
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> Favourite Artists </h2>
	</div>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php if($favourite_artists) { ?>
			<?php foreach ($favourite_artists as $artist) { ?>
			<tr>
				<td> <?= $artist->artist_name; ?> </td>
				<td> Viewed <?= $artist->views ?> times </td>
			</tr>
			<?php } ?>
		<?php } else { ?>
		<h4 class="margin-bottom text-center"> No artists viewed yet </h4>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	$('.carousel').carousel({
		pause: "false",
	});
</script>