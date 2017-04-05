<?php 


	if (!isset($fm_tracks)) { ?>
	<h5 class="setlistHeader"> Setlist: <?= $db_tracks[0]->artist_name ?> at <?= $db_tracks[0]->gig_venue ?>, <?= $db_tracks[0]->gig_city ?>, <?= $db_tracks[0]->gig_country ?> - <?= date('d/m/Y', strtotime($db_tracks[0]->gig_date)) ?> 
	</h5>
	<form action="" method="POST">
		<table class="table table-hover">
			<thead>
				<td> Order </td>
				<td> Track </td>
				<td></td>
			</thead>
			<tbody>
				<tr>
					<td class="setOrder"> 1 </td>
					<td class="setName"><input type="text" name="track[]" class="form-control"></td>
					<td><i class="fa fa-plus addSetTrack"></i></td>
				</tr>
			</tbody>
		</table>		
	</form>
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