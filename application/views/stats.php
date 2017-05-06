<p class='bold'>Library Progress: </p>
<div class='progress'>
    <div class='progress-bar' role='progressbar' aria-valuenow='<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>'
         aria-valuemin='0' aria-valuemax='100' style='width:<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>%'>
    </div>
</div>
<p class='headerstat'> Listened to <?= $cd_listened_count ?>/<?= $cd_count ?> (<?= ($cd_listened_count > 0 ? round( ($cd_listened_count / $cd_count ) * 100, 2 ) : '0') ?>%) </p>
<p class='headerstat'> Added this week: <?= $cd_week; ?> </p>
<p class='headerstat'> Added this month: <?= $cd_month ?> </p>
<p class='headerstat'> Added this year: <?= $cd_year ?> </p>
