<!-- <div class="row">
		<div class="col-xs-12 col-sm-5 homeSquare left">
				<div class="text text-center">
						<i class="fa fa-music"></i><br>
						<h5> Recently Added </h5>
				</div>
				<div class="recentlyAdded">
			<?php
				$count = 0;
				foreach ($recently_added as $item) {
					echo '
						<div id="item'. $count .'">
									<p>
											'. $item->title .' - '. $item->artist_name .'
									</p>
									<a href="/item/'. $item->item_id .'" class="viewItemBtn"> View </a>
						</div>
					';
					$count++;
				}
			?>
		</div>
	</div>
	<div class="col-sm-2"></div>
	<div class="col-xs-12 col-sm-5 homeSquare">
		<div class="text text-center">
			<i class="fa fa-headphones"></i><br>
			<h5> Recently Listened </h5>
		</div>
	</div>
</div> -->
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