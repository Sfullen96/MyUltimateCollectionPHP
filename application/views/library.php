<table class="table table-hover" id="libraryTable">
	<thead>
		<tr>
			<th style="display: none"> ID </th>
			<th> Title </th>
			<th> Artist </th>
			<th> Artist A-Z </th>
			<th> Reference </th>
			<th> Purchased On </th>
			<th> Purchased From </th>
			<th> Rating </th>
			<th> Listened </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($items as $item) { ?>
		<tr>
			<td style="display: none"><?= $item->item_id; ?></td>
			<td><a href="/item/<?=$item->item_id;  ?>"><?= $item->title; ?></a></td>
			<td><a href="/artist/<?= $item->artist_id; ?>"><?= $item->artist_name; ?></a></td>
			<td><?= $item->artist_az_name; ?></td>
			<td><?= $item->reference; ?></td>
			<td><?= ($item->purchase_date != null?date('d/m/Y', strtotime($item->purchase_date)):'N/A'); ?></td>
			<td><?= $item->purchased_from; ?></td>
			<td><?= $item->rating; ?>/10</td>
			<td><?= ($item->listened == 1?'Yes':'No'); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
	    $('#libraryTable').DataTable({
	    	"pageLength": 50,
	    	"order": [0, 'ASC']
	    });
	});
</script>