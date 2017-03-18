<?php
echo "<pre>" . print_r($item_info, TRUE) . "</pre>";
?>
<div class="row">
	<div class="col-xs-12 col-sm-7">
		<h3> <?= $item_info[0]->title ?> - <?= $item_info[0]->artist_name ?> </h3>
	</div>
	<div class="col-xs-12 col-sm-5 ratingContainer">
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
</div>