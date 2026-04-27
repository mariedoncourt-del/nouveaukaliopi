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
$route['default_controller'] = 'welcome';
$route['admin/delete_formation/(:any)'] = 'admin/delete_formation/$1';
$route['admin/delete_apprenant/(:any)'] = 'admin/delete_apprenant/$1';
$route['admin/delete_cours/(:any)'] = 'admin/delete_cours/$1';
$route['admin/delete_prof/(:any)'] = 'admin/delete_prof/$1';
$route['welcome/delete_seance/(:any)'] = 'welcome/delete_seance/$1';
$route['welcome/delete_besoin/(:any)'] = 'welcome/delete_besoin/$1';
$route['welcome/delete_scenario/(:any)'] = 'welcome/delete_scenario/$1';
$route['welcome/delete_evaluation/(:any)'] = 'welcome/delete_evaluation/$1';
$route['welcome/delete_evaluation_pro/(:any)'] = 'welcome/delete_evaluation_pro/$1';
$route['welcome/archive/(:any)'] = 'welcome/archive/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
