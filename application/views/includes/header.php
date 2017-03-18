<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <head>
        <!-- META -->
        <meta charset="utf-8">
        <meta name="author" content="Sam Fullen">
        <meta name="keywords" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="description" content="<?= (isset($meta_content)?$meta_content:'') ?>" />
        <!-- Optional canonical tag -->
        <?php if(isset($canonical)) { ?>
        <link rel="canonical" href="<?= $canonical; ?>" />
        <?php } ?>
        <!-- TITLE -->
        <title><?php echo $title;?></title>
        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <!-- JS LIBS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/f2ac442258.js"></script>
        <script src="//cdn.rawgit.com/tonystar/bootstrap-hover-tabs/master/bootstrap-hover-tabs.js"></script>
        <!-- CSS LIBS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- CSS -->
        <link href="<?= base_url(); ?>css/main.css?cache=<?= time(); ?>" media="screen" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/style.css?cache<?= time(); ?>">
        <!-- JS -->
        <script src="<?= base_url(); ?>js/app.js?cache=<?= time(); ?>"></script>
        <!-- IE -->
        <!--[if lt IE 9]><script src="js/respond.min.js"></script><![endif]-->
        <!--[if gte IE 9]>
        <style type="text/css">
        .gradient {filter: none !important;}
        </style>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="row">
                <!-- Primary Navigation -->
                <nav class="navbar navbar-primary <?= ($_SERVER['REQUEST_URI'] == '/home' || $_SERVER['REQUEST_URI'] == '/' ?'margin-none':''); ?>">
                    <div>
                        <div class="navbar-header" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <button type="button" class="navbar-toggle collapsed navbar-toggle-center" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"></button>
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                        <div class="collapse navbar-collapse navbar-nav-justified" id="bs-example-navbar-collapse-1">
                            <ul class="nav nav-pills nav-justified">
                                <li class="<?= ($_SERVER['REQUEST_URI'] == '/home' || $_SERVER['REQUEST_URI'] == '/'?'active':'') ?>"><a href="/">Home</a></li>
                                <!-- <li><a href="/get-listed">Get listed</a></li> -->
                                <li class="<?= ($_SERVER['REQUEST_URI'] == '/add-cd'?'active':'') ?>"><a href="/add-cd">Add to Library</a></li>
                                <li class="<?= ($_SERVER['REQUEST_URI'] == '/library'?'active':'') ?>"><a href="/library">View Library</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!--/ Primary Navigation -->
        <div class="container">