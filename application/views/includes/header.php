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
        <link rel="manifest" href="/manifest.json">
        <link rel="stylesheet" type="text/css" href="">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <!-- JS LIBS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/f2ac442258.js"></script>
        <script src="//cdn.rawgit.com/tonystar/bootstrap-hover-tabs/master/bootstrap-hover-tabs.js"></script>
        <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>
        <script type="text/javascript" src=//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js></script>
        <!-- CSS LIBS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/jquery-ui-theme.css?cache=<?= time(); ?>">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
        <!-- CSS -->
        <link href="<?= base_url(); ?>css/main.css?cache=<?= time(); ?>" media="screen" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/style.css?cache<?= time(); ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/css/responsive.css?cache=<?= time() ?>">
        <!-- JS -->
        <script src="<?= base_url(); ?>js/app.js?cache=<?= time(); ?>"></script>
        <script src="<?= base_url(); ?>js/note.js?cache=<?= time(); ?>"></script>
        <script src="<?= base_url(); ?>js/edit.js?cache=<?= time(); ?>"></script>
        <script src="<?= base_url(); ?>js/tracks.js?cache=<?= time(); ?>"></script>
        <script src="<?= base_url(); ?>js/add-cd.js?cache=<?= time(); ?>"></script>
        <script src="<?= base_url(); ?>js/setlist.js?cache=<?= time(); ?>"></script>
        <script src="<?= base_url(); ?>js/library.js?cache=<?= time(); ?>"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
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
        <div class="container-fluid">
            <div class="row">
                <!-- Primary Navigation -->
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            </button>
                            <!-- <a class="navbar-brand" href="#">Brand</a> -->
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">Link</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                            <form class="navbar-form navbar-left" method="POST" action="/search/index">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control margin-bottom" name="keyword" placeholder="Search..." value="<?= (isset($_POST['keyword'])?$_POST['keyword']:''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <button type="submit" class="btn btn-default headerSearch">Search</button>
                                    </div>
                                </div>
                                
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="<?= ($_SERVER['REQUEST_URI'] == '/home' || $_SERVER['REQUEST_URI'] == '/'?'active':'') ?>"><a href="/">Home</a></li>
                                <!-- <li><a href="/get-listed">Get listed</a></li> -->
                                <li class="<?= ($_SERVER['REQUEST_URI'] == '/add-cd'?'active':'') ?>"><a href="/add-cd">Add to Library</a></li>
                                <li class="<?= ($_SERVER['REQUEST_URI'] == '/library'?'active':'') ?>"><a href="/library">View Library</a></li>
                                <li><a class="<?= ($_SERVER['REQUEST_URI'] == '/artists'?'active':'') ?>" href="/artists"> Artists </a></li>
                                <?php if(empty($this->session->userdata('is_logged_in'))) { ?>
                                <li class="<?= ($_SERVER['REQUEST_URI'] == '/login'?'active':'') ?>"><a href="/login">Login</a></li>
                                <?php } else { ?>
                                <li class=""><a href="/logout">Logout</a></li>
                                <?php } ?>
                            </ul>
                            </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
                <!--/ Primary Navigation -->
                <div class="<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/home'?'container-fluid':'container') ?> main-content">
                    <?php
                    if(empty($this->session->userdata('is_logged_in')) && $_SERVER['REQUEST_URI'] != '/login') {
                    header('Location: ' . base_url() . 'login');
                    exit();
                    }
                    ?>