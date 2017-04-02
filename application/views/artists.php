<table class="table table-hover" id="artistsTable">
	<thead>
		<tr>
			<th style="display: none"> ID </th>
			<th> Artist Name </th>
			<th> Artist A-Z </th>
			<th> No. CD's </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($artists as $artist) { ?>
		<tr>
			<td style="display: none"><?= $artist->artist_id; ?></td>
			<td><a href="/artist/<?= $artist->artist_id; ?>"><?= $artist->artist_name; ?></a></td>
			<td><?= $artist->artist_az_name; ?></td>
			<td><?= $artist->cd_count; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
	    $('#artistsTable').DataTable({
	    	"pageLength": 50,
	    	aaSorting: [[2, 'DESC']]
	    });
	});
</script>