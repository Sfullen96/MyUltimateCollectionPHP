<h5 class="setlistHeader"> Setlist: <?= $tracks->setlist->artist->{'@name'} ?> at <?= $tracks->setlist->venue->{'@name'} ?>, <?= $tracks->setlist->venue->city->{'@name'} ?>, <?= $tracks->setlist->venue->city->country->{'@name'} ?> - <?= $tracks->setlist->{'@eventDate'} ?> </h5>

<table class="table table-hover">
	<thead>
		<td> Order </td>
		<td> Track </td>
	</thead>
	<tbody>
		<?php 
			$counter = 1;
			foreach ($tracks->setlist->sets->set->song as $key => $value) {
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