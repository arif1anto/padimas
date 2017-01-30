<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "frontend/chome/halaman/beranda";
$route['404_override'] = '';
$route['artikel/(:any)'] = 'frontend/chome/detail/$1';
$route['artikel'] = 'frontend/chome';
$route['page/(:num)'] = 'frontend/chome/page/$1';
$route['page'] = 'frontend/chome/page';
$route['halaman/(:any)'] = 'frontend/chome/halaman/$1';
$route['halaman'] = 'frontend/chome/halaman';
$route['program'] = 'frontend/chome/program';
$route['program/(:any)'] = 'frontend/chome/program/$1';
$route['pengumuman'] = 'frontend/chome/pengumuman';
$route['pengumuman/(:any)'] = 'frontend/chome/pengumuman/$1';
$route['pendaftaran'] = 'frontend/cpendaftaran';
$route['pendaftaran/(:any)'] = 'frontend/cpendaftaran/$1';
$route['image'] = 'frontend/cimage/thumbnail';
$route['image/(:any)'] = 'frontend/cimage/thumbnail/$1';

// $route['operator'] = 'operator/coperator';
// $route['operator/(:any)'] = 'operator/coperator/$1';

$route['maba'] = 'frontend/clokal';
$route['maba/(:any)'] = 'frontend/clokal/$1';
$route['ajax/(:any)'] = 'frontend/chain/$1';
$route['ajax'] = 'frontend/chain';

$route['admin'] = 'admin/cadmin';
$route['admin/upload'] = 'admin/cupload';
$route['admin/artikel/(:any)'] = 'admin/cartikel/$1';
$route['admin/artikel'] = 'admin/cartikel';
$route['admin/halaman/(:any)'] = 'admin/cpage/$1';
$route['admin/halaman'] = 'admin/cpage';
$route['admin/program/(:any)'] = 'admin/cprogram/$1';
$route['admin/program'] = 'admin/cprogram';
$route['admin/pengumuman/(:any)'] = 'admin/cpengumuman/$1';
$route['admin/pengumuman'] = 'admin/cpengumuman';
$route['admin/konfigurasi/(:any)'] = 'admin/ckonfig/$1';
$route['admin/konfigurasi'] = 'admin/ckonfig';
$route['admin/test/(:any)'] = 'admin/ctest/$1';
$route['admin/test'] = 'admin/ctest';
$route['admin/login'] = 'admin/clogin';
$route['admin/logout'] = 'admin/clogin/logout';
$route['admin/menu/(:any)'] = 'admin/cmenu/$1';
$route['admin/menu'] = 'admin/cmenu';
$route['admin/export/(:any)'] = 'admin/cexport/$1';
$route['admin/export'] = 'admin/cexport';
$route['admin/data'] = 'admin/cdata';
$route['admin/data/(:any)'] = 'admin/cdata/$1';
$route['admin/pendaftaran/(:any)'] = 'admin/cpendaftaran/$1';
$route['admin/pendaftaran'] = 'admin/cpendaftaran';
$route['admin/ajax/(:any)'] = 'admin/chain/$1';
$route['admin/ajax'] = 'admin/chain';
$route['admin/(:any)'] = 'admin/cadmin/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
