<form action="<?= (isset($edit)?'/review/updateReview':'/review/addReview'); ?>" method="POST" role="form">
	<legend><?= (isset($edit)?'Update a review':'Post a review'); ?></legend>
	<input type="hidden" name="item_id" value="<?= $item_id; ?>">

	<div class="form-group">
		<label for=""> Review </label>
		<textarea placeholder="Review..." name="review" class="form-control" rows="8"><?= (isset($edit)?$review:''); ?></textarea>
	</div>

	<button type="submit" class="btn btn-primary addReview"> Add Review </button>
</form>