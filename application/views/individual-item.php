<?php
if (isset($_GET['debug'])) {
	echo "<pre>" . print_r($item_info, TRUE) . "</pre><br>";
	echo "<pre>" . print_r($tracks, TRUE) . "</pre><br>";
	echo "<pre>" . print_r($notes, TRUE) . "</pre><br>";
	echo "<pre>" . print_r($similar_artists, TRUE) . "</pre><br>";
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

<?php if(isset($_GET['exists'])) { ?>
		
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Item successfully added. You can edit the item here, you can also add a track listing.
	</div>

<?php } ?>

<div class="row margin-bottom">
	<div class="col-xs-12 col-sm-4">
		<img src="<?= ($item->image > ''?$item->image:base_url().'images/default.png'); ?>" class="img-responsive albumImage">
	</div>
	<div class="col-xs-12 col-sm-8 ratingContainer">
		<div class="albumInfo">
            <h5 class="albumFormat"> <span class="bold"> Ref #</span><span class="editable" id="reference" data-table="library" data-itemid="<?= $item->item_id; ?>"><?= (isset($item->reference)?$item->reference:'N/A'); ?> </span> </h5>
            <h5 class="albumFormat">
                <span><?= (isset($item->name)? $item->name :'N/A'); ?> </span> |
                <span><?= (isset($item->format_name)? $item->format_name:'N/A'); ?> </span> |
                <span><?= (isset($item->disc_count)?$item->disc_count . ' Disc(s)':'N/A'); ?></span>
            </h5>
			<h2 class="albumTitle editable" id="title" data-table="library" data-itemid="<?= ucwords($item->item_id) ?>"> <?= ucwords($item_info[0]->title); ?> </h2>
			<h5 class="extraInfo"> By <a href="/artist/<?= $item->artist_id ?>"> <?= ucwords($item_info[0]->artist_name); ?> </a> <?= (isset($trackCount)?' | ' . $trackCount . ' tracks, ':''); ?>  <?= (isset($totalAlbumTime)?$totalAlbumTime:''); ?> </h5>
			<div class="rating">
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
			</div>
			<?= ($review?'<a href="/review-edit/' . $item->item_id . '" class="reviewLink"> Edit Album Review </a>':'<a href="/review/' . $item->item_id . '" class="reviewLink"> Review This Album </a>'); ?>
			
			<br>
			<p class="albumSummary margin-bottom" id="summary" data-table="library" data-itemid="<?= $item->item_id; ?>">
				<?= (isset($item->summary)?trim($item->summary):'No summary found.'); ?>
			</p>
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
					if (!empty($tracks)) {

						$trackCount = count($tracks);

						foreach ($tracks as $track) {
							$duration = gmdate("i:s", $track->track_duration);
							echo '
								<tr data-trackid="'. $track->track_id .'">
									<td>'. $track->track_album_number .'</td>
									<td class="editableTrack" id="track_name" data-trackid="'. $track->track_id .'" data-itemid="'. $item->item_id .'" data-order="'. $track->track_album_number .'">'. ucwords($track->track_name) .'</td>
									<td class="editableTrack" id="track_duration" data-trackid="'. $track->track_id .'" data-itemid="'. $item->item_id .'" data-order="'. $track->track_album_number .'">'. $duration .'</td>
									<td><i class="fa fa-times deleteTrack"></i></td>
								</tr>
							';
						}

						$newTrackId = $trackCount+=1;
						echo '
							<tr id="newTrackTr" data-id="'. $newTrackId .'" data-itemid="'. $item->item_id .'" data-artist="'. $item->artist_id .'">
								<td>'. $newTrackId .'</td>
								<td><input type="text" class="form-control" placeholder="Track Name" name="trackName" id="trackName" /></td>
								<td><input type="time" class="form-control" placeholder="Track Duration" name="duration" /></td>
								<td><i class="fa fa-plus addTrack"></i></td>
							</tr>
						';
					} else {
						// No track listing currently
						$newTrackId = 1;
						echo '
							<tr id="newTrackTr" data-id="'. $newTrackId .'" data-itemid="'. $item->item_id .'" data-artist="'. $item->artist_id .'">
								<td>'. $newTrackId .'</td>
								<td><input type="text" class="form-control" placeholder="Track Name" name="trackName" id="trackName" /></td>
								<td><input type="time" class="form-control" placeholder="Track Duration" name="duration" /></td>
								<td><i class="fa fa-plus addTrack"></i></td>
							</tr>
						';
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="col-xs-12 col-sm-6 notesContainer">
		<h4> Notes </h4>
		<div class="notes">
			<?php 
				if($notes) {
					foreach ($notes as $note) {
						echo '
							<div class="note">
								<p> '. $note->note .' | <small>'. date('d/m/y H:i:s', strtotime($note->note_timestamp)) .'</small> </p>
								<hr>
							</div>
						';
					}
				} else {
					echo '
						<div class="note">
							<p> No notes added yet </p>
							<hr>
						</div>
					';
				}

			?>
		</div>
		<textarea class="form-control noteText" id="textarea" data-id="<?= $item->item_id; ?>" rows="3" placeholder="Add a note..."></textarea>
		<button class="btn addNote"> Add Note </button>
	</div>
</div>

<div class="row">
	<div class="moreInfoBanner col-xs-12">
		<div class="row">
			<div class="col-xs-12">
				<p> Purchased from <span class="editable" id="purchased_from" data-table="library" data-itemid="<?= $item->item_id; ?>"><?= (isset($item->purchased_from) && $item->purchased_from > ''?$item->purchased_from:'N/A'); ?></span> on <span class="editable" id="purchase_date" data-table="library" data-itemid="<?= $item->item_id; ?>"><?= (isset($item->purchase_date) && $item->purchase_date > ''?date('d/m/Y', strtotime($item->purchase_date)):'N/A'); ?>
				</span></p>
			</div>
		<!-- 	<div class="col-xs-12 col-sm-6">
				<p> Purchased at: <span class="editable" id="purchased_from" data-table="library" data-itemid="<?= $item->item_id; ?>"><?= (isset($item->purchased_from) && $item->purchased_from > ''?$item->purchased_from:'N/A'); ?></span></p>
			</div> -->
		<!-- 	<div class="col-xs-12 col-sm-4">
				<p> Item Ref: <span class="editable" id="reference" data-table="library" data-itemid="<?= $item->item_id; ?>"><?= (isset($item->reference)?$item->reference:'N/A'); ?> </span></p>
			</div> -->
			<!-- <div class="col-xs-12 col-sm-4">
				<p> CD Count: <span class="editable" id="cd_count" data-table="library" data-itemid="<?= $item->item_id; ?>"><?= (isset($item->cd_count)?$item->cd_count:'N/A'); ?> </span></p>
			</div> -->
		</div>
	</div>
</div>

<!-- Similar Artists -->
<?php if ( count( $similar_artists ) ) { ?>
<h3> Similar Artists to <?= $item->artist_name; ?> </h3>

<div class="row">
	<?php 

		foreach ($similar_artists->similarartists->artist as $similarArtist) {
			$column = 12 / count($similar_artists->similarartists->artist);

			echo '
			<div class="col-xs-6 col-sm-'. $column .'">
				<div class="similarArtist" style="background-image: url(\''. $similarArtist->image[2]->{'#text'} .'\');background-size: cover">
					<div class="overlay">
						<div class="text">
							<h6 class="similarName"> '. $similarArtist->name .' </h6>
							<a href="https://www.amazon.co.uk/s/ref=sr_nr_p_lbr_music_artists__0?fst=as%3Aoff&rh=n%3A229816%2Ck%3A'. $similarArtist->name .'%2Cp_lbr_music_artists_browse-bin%3A'. $similarArtist->name .'&keywords='. $similarArtist->name .'&ie=UTF8&qid=1491552380&rnid=2565831031" target="_blank"> Search on Amazon </a>
						</div>
					</div>
				</div>
			</div>
			';
		}

	?>
</div>
<?php } ?>