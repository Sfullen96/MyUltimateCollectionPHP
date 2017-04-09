<form action="<?= (isset($edit)?'/artist/editSummary':'/artist/addSummary'); ?>" method="POST" role="form">
	<legend><?= (isset($edit)?'Update a Summary':'Post a Summary'); ?></legend>
	<input type="hidden" name="artist_id" value="<?= $artist_id; ?>">

	<div class="form-group">
		<label for=""> Artist Summary </label>
		<textarea placeholder="Summary..." name="summary" class="form-control" rows="8"><?= (isset($edit)?$summary:''); ?></textarea>
	</div>

	<button type="submit" class="btn btn-primary addReview"> Add Summary </button>
</form>