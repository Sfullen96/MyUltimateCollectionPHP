<?php 
	
	if (!isset($fm_tracks)) { ?>
		<h5 class="setlistHeader"> Setlist: <?= $gig[0]->artist_name ?> at <?= $gig[0]->gig_venue ?>, <?= $gig[0]->gig_city ?>, <?= $gig[0]->gig_country ?> - <?= date('d/m/Y', strtotime($gig[0]->gig_date)) ?> 
		</h5>
		<?php if(!$setlist) { ?>
			<form action="/gig/addSetlist" method="POST">
				<input type="hidden" name="gig_id" value="<?= $gig[0]->gig_id; ?>">
				<table class="table table-hover">
					<thead>
						<td> Order </td>
						<td> Track </td>
						<td></td>
					</thead>
					<tbody>
						<tr>
							<td class="setOrder"> 1 </td>
							<td class="setName"><input type="text" name="tracks[]" class="form-control"></td>
							<td><i class="fa fa-plus addSetTrack"></i></td>
						</tr>
					</tbody>
				</table>
				<input type="submit" class="btn btn-primary margin-bottom" name="" value="Add Setlist">		
			</form>
		<?php } else { ?>
			<table class="table table-hover">
				<thead>
					<td> Order </td>
					<td> Track </td>
				</thead>
				<tbody>
					<?php 
						$counter = 1;
						foreach ($setlist as $song) {
							echo '
								<tr>
									<td>'. $counter .'</td>
									<td>'. $song->track_name .'</td>
								</tr>
							';
							$counter++;
						}
					?>
				</tbody>
			</table>
		<?php } ?>
	<?php } else {

?>

<h5 class="setlistHeader"> Setlist: <?= $fm_tracks->setlist->artist->{'@name'} ?> at <?= $fm_tracks->setlist->venue->{'@name'} ?>, <?= $fm_tracks->setlist->venue->city->{'@name'} ?>, <?= $fm_tracks->setlist->venue->city->country->{'@name'} ?> - <?= $fm_tracks->setlist->{'@eventDate'} ?> </h5>

<table class="table table-hover">
	<thead>
		<td> Order </td>
		<td> Track </td>
	</thead>
	<tbody>
		<?php 
			$counter = 1;
			foreach ($fm_tracks->setlist->sets->set->song as $key => $value) {
				echo '
					<tr>
						<td>'. $counter .'</td>
						<td>'. $value->{'@name'} .'</td>
					</tr>
				';
				$counter++;
			}
		?>
	</tbody>
</table>

<?php } ?>