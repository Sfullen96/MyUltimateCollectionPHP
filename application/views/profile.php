<h2> <?= $accountInfo->username ?>'s Profile </h2>
<h5 class="margin-bottom"> Member Since: <?= date( 'd/m/Y', strtotime( $accountInfo->created_at ) ); ?> </h5>
<p class='bold'>Library Progress: <?= $cd_listened_count . '/' . $cd_count; ?> (<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>%) </p>
<div class="row">
    <div class="col-xs-12 col-sm-5">
        <div class='progress'>
            <div class='progress-bar' role='progressbar' aria-valuenow='<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>'
                 aria-valuemin='0' aria-valuemax='100' style='width:<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>%'>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="artistBanner margin-bottom col-xs-12 text-center">
        <h2> Top Items... </h2>
    </div>
</div>
<div class="row">
    <?php $counter = 0; ?>
    <?php foreach( $top_items as $item ) { ?>
        <?php if ( $counter < 4 ) { ?>
            <div class="col-xs-12 col-sm-6 col-md-3 homeCarItem margin-bottom">
                <a href="/item/<?= $item->item_id ?>"><img src="<?= ($item->image?$item->image:base_url() . 'images/default.png'); ?>" class="img-responsive margin-bottom"></a>
                <h4 class="margin-bottom"> <a href="/item/<?= $item->item_id ?>"><?= ucwords($item->title); ?></a> </h4>
                <h6> <a href="/artist/<?= $item->artist_id ?>"><?= ucwords($item->artist_name); ?></a> </h6>
            </div>
        <?php } ?>
        <?php $counter++; ?>
    <?php } ?>
</div>
<div class="row margin-top">
    <div class="artistBanner margin-bottom col-xs-12 text-center">
        <h2> Top Artists... </h2>
    </div>
</div>
<div class="row">
    <?php $counter = 0; ?>
    <?php foreach( $top_artists as $artist ) { ?>
        <?php if ( $counter < 4 ) { ?>
            <div class="col-xs-12 col-sm-6 col-md-3 homeCarItem">
                <a href="/artist/<?= $artist->artist_id ?>"><img src="<?= ($artist->artist_image?$artist->artist_image:base_url() . 'images/default.png'); ?>" class="img-responsive margin-bottom"></a>
                <h4 class="margin-bottom"> <a href="/artist/<?= $artist->artist_id ?>"><?= ucwords($artist->artist_name); ?></a> </h4>
            </div>
        <?php } ?>
        <?php $counter++; ?>
    <?php } ?>
</div>