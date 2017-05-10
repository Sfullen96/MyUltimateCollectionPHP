<div class="profileBlock">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <img src="<?= ($accountInfo->image?$accountInfo->image:base_url() . 'images/default-user.png'); ?>" class="img-responsive resultImage">
        </div>
        <div class="col-xs-12 col-sm-8">
            <h2 class="title margin-bottom"> <?= $accountInfo->username ?>'s Profile </h2>
            <h5 class="margin-bottom"> Member Since: <?= date( 'd/m/Y', strtotime($accountInfo->created_at ) ); ?> </h5>
            <h5> <?= $cd_count ?> items in their library </h5>
            <ul>
                <li> <?= $breakdown['cds'] ?> CD's </li>
                <li> <?= $breakdown['vinyls'] ?> Vinyls </li>
                <li> <?= $breakdown['cassettes'] ?> Cassettes </li>
                <li> <?= $breakdown['dvds'] ?> DVD's </li>
            </ul>
        </div>
    </div>
</div>

<div class="profileBlock">
    <h2 class="title">Library Progress: </h2>
    <p class='bold margin-bottom'><?= $cd_listened_count . '/' . $cd_count; ?> (<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>%) items listened to</p>
    <div class="row">
        <div class="col-xs-12">
            <div class='progress'>
                <div class='progress-bar' role='progressbar' aria-valuenow='<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>'
                     aria-valuemin='0' aria-valuemax='100' style='width:<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>%'>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="profileBlock">
    <?php if ( isset( $recentActivity ) ) { ?>
    <h2> Recent Activity </h2>
    <div class="row profileFeed margin-bottom">
        <div class="col-xs-12">
            <?php foreach( $recentActivity as $date => $activity ) { ?>
                <div class="row profileFeedItem <?= $activity['type'] ?>">
                    <div class="col-xs-2">
                        <img src="<?= ( $activity['image'] > '' ? $activity['image'] : base_url() . 'images/default.png' ) ?>" alt="" class="img-responsive">
                    </div>
                    <div class="col-xs-10">
                        <h4>Recently <?= $activity['typeWord'] ?>:
                        <br>
                        <a href="/item/<?= $activity['itemId'] ?>"> <?= ucwords( $activity['title'] ) ?></a>
                        <br>
                        <a href="/artist/<?= $activity['artistId'] ?>"> <?= ucwords( $activity['artist'] ) ?></a>
                        </h4>
                        <p> <i> <?= Date( 'd/m/Y H:i:s', strtotime( $date ) ) ?> </i> </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>

<div class="profileBlock">
    <h2 class="title margin-bottom"> Top Items... </h2>
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
</div>

<div class="profileBlock">
    <h2 class="title margin-bottom"> Top Artists... </h2>
    <div class="row">
        <?php $counter = 0; ?>
        <?php foreach( $top_artists as $artist ) { ?>
            <?php if ( $counter < 4 ) { ?>
                <div class="col-xs-12 col-sm-6 col-md-3 homeCarItem">
                    <a href="/artist/<?= $artist->artist_id ?>"><img src="<?= ($artist->artist_image > ''?$artist->artist_image:base_url() . 'images/default.png'); ?>" class="img-responsive margin-bottom"></a>
                    <h4 class="margin-bottom"> <a href="/artist/<?= $artist->artist_id ?>"><?= ucwords($artist->artist_name); ?></a> </h4>
                </div>
            <?php } ?>
            <?php $counter++; ?>
        <?php } ?>
    </div>
</div>
