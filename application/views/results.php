<h1 class="margin-bottom"> Search Results for: <?= $keyword; ?> </h1>
<?php if($item_results) { ?>
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> <i class="fa fa-music"></i> Album Results </h2>
	</div>
</div>
<div class="results">
<?php foreach ($item_results as $item) { ?>
<?php foreach ($item as $i) { ?>
<div class="row result">
	<div class="col-xs-3">
		<a href="/item/<?= $i->item_id ?>"><img src="<?= ($i->album_image?$i->album_image:base_url() . 'images/default.png'); ?>" class="img-responsive resultImage"></a>
	</div>
	<div class="col-xs-9">
		<div class="albumInfo">
			<h5 class="albumFormat"> <?= $i->format_name ?> | #<?= $i->item_id; ?> </h5>
			<h2 class="albumTitle editable" id="title" data-table="library" data-itemid="<?= $i->item_id ?>"> <?= ucwords($i->title) ?> </h2>
			<h5 class="extraInfo"> By <a href="/artist/<?= $i->artist_id ?>"> <?= ucwords($i->artist_name) ?> </a> </h5>
		</div>
	</div>
</div>
<hr>
<?php } ?>
<?php } ?>
</div>
<a class="showMoreResults" href="javascript:void(0)"> Show All Results... </a>
<?php } else { ?>
	<h4 class="margin-bottom"> No Albums Found </h4>
<?php } ?>

<?php if($artist_results) { ?>
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> <i class="fa fa-music"></i> Artist Results </h2>
	</div>
</div>
<?php foreach ($artist_results as $artist) { ?>
<?php foreach ($artist as $a) { ?>
<div class="row">
	<div class="col-xs-12">
		<div class="albumInfo">
			<h2 class="extraInfo"> <a href="/artist/<?= $a->artist_id ?>"> <?= ucwords($a->artist_name) ?> </a> </h2>
		</div>
	</div>
</div>
<hr>
<?php } ?>
<?php } ?>
<?php } else { ?>
	<h4 class="margin-bottom"> No Artists Found </h4>
<?php } ?>