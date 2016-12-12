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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['menu'] = 'menu/welcome/index';
$route['inventory'] = 'inventory/welcome/index';
$route['inventory/(:num)'] = 'inventory/detail/detail/$1';
$route['recipe/(:num)'] = 'recipe/detail/detail/$1';
$route['test/(:any)'] = 'welcome/counte/$1';
$route['cart'] = 'menu/cart/index';
$route['menu/additem/(:num)'] = 'menu/welcome/add_item_to_order/$1';
$route['cart/checkout'] = 'menu/cart/checkout';
$route['cart/cancel'] = 'menu/cart/cancel';
$route['sales_order'] = 'menu/welcome/sales_order';
$route['order/examine/(:num)'] = 'menu/welcome/examine/$1';
$route['recipe/edit/(:any)'] = 'recipe/detail/edit/$1';
$route['toggle'] = 'toggle/index/switch_userrole';
$route['menu/create-item'] = 'menu/crud/index';
$route['unauthorize'] = 'unauthorize/index';
$route['menu/create'] = 'menu/crud/create';
$route['menu/cancel'] = 'menu/crud/cancel';
$route['newmenu/save'] = 'menu/crud/save';
$route['menu-item-delete/(:num)'] = 'menu/crud/delete/$1';
