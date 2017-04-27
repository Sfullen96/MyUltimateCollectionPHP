<?php if(isset($_GET['exists'])) { ?>
		
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Looks like this item already exists in the library. If you want to edit it you can do so here: <br>
		<a href="/item/<?= $_GET['id']; ?>"> Item </a>
	</div>

<?php } ?>

<div class="alert alert-danger addError">
</div>

<div class="chooseFormat">
    <h3 class="text-center margin-bottom"> What type of item are you adding today? </h3>
    <div class="row">
        <?php foreach( $itemTypes as $itemType ) { ?>
            <div class="col-xs-12 col-sm-<?= 12 / count( $itemTypes ) ?> itemType square" data-id="<?= $itemType->id ?>" style="background-image: url( '<?= base_url() ?>images/<?= $itemType->name ?>.png' );background-size: cover">
                <div class="overlayBox"></div>
                <h1 class="text"> <?= strtoupper( $itemType->name ); ?> </h1>
            </div>
        <?php } ?>
    </div>
</div>

<form action="/item/addCd" method="POST" role="form" id="addCdForm">
	<legend> Add a new item to the library </legend>
    <div class="step1">
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
    </div>
    <div class="step2">
	<div class="stepHeader">
		<h4> Step 2: Item Details </h4>
	</div>
        <div class="step">
            <label for="reference"> Album Reference </label>
            <input type="text" id="reference" class="form-control" name="reference" placeholder="Album Reference" />

            <label for="summary" style="display: none"> Summary </label>
            <textarea style="display: none" placeholder="Album Summary" id="summary" class="form-control" rows="7" name="summary"></textarea>

            <div class="form-group">
                <label for="format"> Format </label>
                <select class="form-control formatDropdown" id="format" name="format">
                <option selected="selected" disabled="disabled" value="0"> Choose a format </option>

                </select>
            </div>

            <label for="cd_count"> Disc Count </label>
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
    </div>
    <div class="step3">
        <h3> Saving your item... </h3>
    </div>
    <div class="stepThree">
        <div class="stepHeader" id="step3Header">
            <h4> Step 3: Tracklist </h4>
        </div>
        <div class="step">
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
    </div>
    <button type="button" class="btn btn-primary btn-next margin-bottom pull-right"> Next Step </button>
    <button type="button" class="btn btn-primary btn-back margin-bottom"> Back </button>
	<button type="submit" class="btn btn-primary addCdBtn margin-bottom"> Add CD </button>
</form>