
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'pages';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['item/(:num)'] = 'item/showIndividualItem/$1';
$route['home'] = 'pages';
$route['get-rating/(:num)'] = 'item/rating/$1';
$route['update-rating/(:num)/(:num)'] = 'item/updateRating/$1/$2';
$route['spotify'] = 'spotify';
$route['spotify-auth/(:any)'] = 'spotify/auth/$1';
$route['last-fm'] = 'lastFmApi/getImages';
$route['temp'] = 'item/temp';
$route['add-note/(:num)'] = 'note/addNote/$1';
$route['updateItem/(:any)/(:any)/(:any)/(:any)'] = 'item/updateItem/$1/$2/$3/$4';
$route['updateTrack/(:any)/(:any)/(:any)/(:any)'] = 'track/updateTrack/$1/$2/$3/$4';
$route['/addTrack'] = 'track/addNewTrack';
$route['review/(:num)'] = 'review/index/$1';
$route['review-edit/(:num)'] = 'review/editReviewView/$1';
$route['add-cd'] = 'item/addCdForm';
$route['library'] = 'item/library';
$route['logout'] = 'login/logout';
$route['login'] = 'login/index';
$route['artists'] = 'artist/index';
$route['artist/(:num)'] = 'artist/showIndividualArtist/$1';
$route['setlist/(:any)'] = 'setlist/showSetlistView/$1';
$route['addListen/(:num)'] = 'item/addListen/$1';
$route['addSummary/(:num)'] = 'artist/addSummaryView/$1';
$route['editSummary/(:num)'] = 'artist/editSummaryView/$1';
$route['admin'] = 'admin';
$route['register'] = 'register';