<?php
if (isset($_GET['debug'])) {
	echo "<pre>" . print_r($item_info, TRUE) . "</pre><br>";
	echo "<pre>" . print_r($tracks, TRUE) . "</pre><br>";
	echo "<pre>" . print_r($notes, TRUE) . "</pre><br>";
}

$item = $item_info[0];

if(!empty($tracks)) {
	$totalAlbumTime = 0;
	$trackCount = 0;

	foreach ($tracks as $track) {
		$totalAlbumTime += $track->track_duration;
		$trackCount++;
	}

	if ($totalAlbumTime < 3600) {
		// less than hour
		$format = "i:s";
	} else {
		// more than an hour
		$format = "H:i:s";
	}
	$totalAlbumTime = gmdate($format, $totalAlbumTime);
}

?>
<div class="row">
	<div class="col-xs-12 col-sm-4">
		<img src="<?= ($item->album_image > ''?$item->album_image:base_url().'images/default.png'); ?>" class="img-responsive">
	</div>
	<div class="col-xs-12 col-sm-8 ratingContainer">
		<div class="albumInfo">
			<h5 class="albumFormat"> <?= $item->format_name ?> | #<?= $item->item_id; ?> </h5>
			<h2 class="albumTitle"> <?= $item_info[0]->title ?> </h2>
			<h5 class="extraInfo"> By <a href="/artist/<?= $item->artist_id ?>"> <?= $item_info[0]->artist_name ?> </a> <?= (isset($trackCount)?' | ' . $trackCount . ' tracks, ':''); ?>  <?= (isset($totalAlbumTime)?$totalAlbumTime:''); ?> </h5>
			<?php 

				foreach ($item_info as $data) {
					$rating = $data->rating;

					for ($i = 0; $i < 10; $i++) { 
						if ($i < $rating) {
							echo '<i class="fa fa-star" id="star'. $i .'" data-id="'. $data->item_id .'" data-original-rating="'. $data->rating .'"></i>';
						} else {
							echo '<i class="fa fa-star-o" id="star'. $i .'" data-id="'. $data->item_id .'" data-original-rating="'. $data->rating .'"></i>';
						}

					}

				}

			?>
			<p class="albumSummary">
				<?= (isset($item->summary)?$item->summary:'No summary, <a href="" class="addSummary"> Add a summary </a>') ?>
			</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="moreInfoBanner col-xs-12">
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<p> Purchased On: <?= (
					isset($item->purchase_date) && $item->purchase_date > ''
					?$item->purchase_date
					:
					'N/A'
					); ?>
				</p>
			</div>
			<div class="col-xs-12 col-sm-3">
				<p> Purchased at: <?= (isset($item->purchased_from) && $item->purchased_from > ''?$item->purchased_from:'N/A'); ?></p>
			</div>
			<div class="col-xs-12 col-sm-3">
				<p> Item Ref: <?= (isset($item->reference)?$item->reference:'N/A'); ?> </p>
			</div>
			<div class="col-xs-12 col-sm-3">
				<p> CD Count: <?= (isset($item->cd_count)?$item->cd_count:'N/A'); ?> </p>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-6 trackListContainer">
		<table class="table table-hover tracks">
			<thead>
				<tr>
					<th> # </th>
					<th> Track </th>
					<th> Duration </th>
				</tr>
			</thead>
			<tbody>
				<?php 

					foreach ($tracks as $track) {
						$duration = gmdate("i:s", $track->track_duration);
						echo '
							<tr>
								<td>'. $track->track_album_number .'</td>
								<td>'. $track->track_name .'</td>
								<td>'. $duration .'</td>
							</tr>
						';
					}

				?>
			</tbody>
		</table>
	</div>
	<div class="col-xs-12 col-sm-6 notesContainer">
		<div class="notes">
			<?php 

				foreach ($notes as $note) {
					echo '
						<div class="note">
							<p> '. $note->note .' | '. date('d/m/y H:i:s', strtotime($note->note_timestamp)) .' </p>
						</div>
					';
				}

			?>
		</div>
	</div>
</div>

