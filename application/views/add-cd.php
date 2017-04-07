<!-- <div class="loading">
	<img src="<?= base_url() ?>/images/loading-gif1.gif">
</div>
 -->
<?php if(isset($_GET['exists'])) { ?>
		
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Looks like this item already exists in the library. If you want to edit it you can do so here: <br>
		<a href="/item/<?= $_GET['id']; ?>"> Item </a>
	</div>

<?php } ?>

<form action="/item/addCd" method="POST" role="form">
	<legend> Add a new CD to the library </legend>
	<div class="stepHeader">
		<h4> Step 1: Artist & Album Name </h4>
	</div>
	<div class="step">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<label> Choose from an existing artist, or add a new artist: </label>
				<input type="text" name="artist" class="form-control existingArtist" placeholder="Artist Name" autocomplete="off" required />
				<br>
				<label id="az"> Artist A-Z Name </label>
				<input type="text" name="artist_az" class="form-control" placeholder="Artist A-Z Name" autocomplete="off" />
			</div>
			<div class="col-xs-12 col-sm-6">
				<label for="title"> Album Title </label>
				<input type="text" id="title" class="form-control" name="title" placeholder="Album Title" autocomplete="off" required />
			</div>
		</div>
	</div>
	<div class="stepHeader">
		<h4> Step 2: CD Details </h4>
	</div>
	<div class="step">
		<label for="reference"> Album Reference </label>
		<input type="text" id="reference" class="form-control" name="reference" placeholder="Album Reference" />

		<label for="summary"> Summary </label>
		<textarea placeholder="Album Summary" id="summary" class="form-control" rows="7" name="summary"></textarea>

		<div class="form-group">
		  	<label for="format"> Format </label>
		  	<select class="form-control" id="format" name="format">
		  	<option selected="selected" disabled="disabled" value="0"> Choose a CD Format </option>
	    	<?php 
	    		foreach ($formats->result() as $row) {
	    			echo '<option value="'. $row->format_id .'">'. $row->format_name .'</option>';
	    		}
	    	?>
		  	</select>
		</div>

		<label for="cd_count"> CD Count </label>
		<input type="number" id="cd_count" class="form-control" name="cd_count" placeholder="CD Count" />

		<div class="albumImage">
			<label for="title"> Album Image </label>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<label> Purchased From: </label>
				<input type="text" name="purchased_from" placeholder="Purchased From" class="form-control">
			</div>
			<div class="col-xs-12 col-sm-4">
				<label> On: </label>
				<input type="text" id="datepicker" name="purchase_date" placeholder="Purchase Date" class="form-control">
			</div>
			<div class="col-xs-12 col-sm-4">
				<label> For: </label>
				<div class="input-group">
				  	<span class="input-group-addon" id="basic-addon1">&pound;</span>
				  	<input type="text" class="form-control" placeholder="Price" name="price" aria-describedby="basic-addon1">
				</div>
			</div>
		</div>
	</div>
	<div class="stepHeader" id="step3Header">
		<h4> Step 3: Tracklist </h4>
	</div>
	<div class="step step3">
		<table class="table table-hover tracks">
			<thead>
				<tr>
					<th> # </th>
					<th> Track </th>
					<th> Duration </th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</div>
	<button type="submit" class="btn btn-primary margin-bottom"> Add CD </button>
</form>