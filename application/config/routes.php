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

$route['default_controller'] = "index";
$route['404_override']       = '';


/**
* Las rutas para agendar
**/
$route['agendar-horario/(:any)-(:any)/(:any)-(:any)']                                   = "index/agendar_horario/$1_$2/$3_$4";
$route['agendar/(:any)-(:any)/(:any)-(:any)/(:any)-(:any)/(:any)-(:any)/(:any)-(:any)'] = "index/agendar/$1_$2/$3_$4/$5_$6/$7_$8/$9_$10";
$route['agendar/(:any)-(:any)/(:any)-(:any)/(:any)-(:any)/(:any)-(:any)']               = "index/agendar/$1_$2/$3_$4/$5_$6/$7_$8";
$route['agendar/(:any)-(:any)/(:any)-(:any)/(:any)-(:any)']                             = "index/agendar/$1_$2/$3_$4/$5_$6";
$route['agendar/(:any)-(:any)/(:any)-(:any)']                                           = "index/agendar/$1_$2/$3_$4";
$route['agendar/(:any)-(:any)-(:any)']                                                  = "index/agendar/$1_$2";
$route['agendar/(:any)-(:any)']                                                         = "index/agendar/$1_$2";
$route['agendar']                                                                       = "index/agendar";

/**
* Ruta para enviar solicitud de amistad
**/
$route['enviar-solicitud/(:any)-(:any)/(:any)-(:any)']                                  = "index/enviar_solicitud/$1_$2/$3_$4";
/**
* Las rutas de agendar con el doctor directamente
**/
$route['doctor/(:any)-(:any)']                                                          = "index/doctor/$1_$2";
$route['amistad/(:any)-(:any)']                                                         = "index/amistad/$1_$2";

$route['ingresar-carnet']                                                               = "index/ingresar_carnet";

/**
* Las rutas de perfil
**/
$route['perfil']                                                                        = "index/perfil";
$route['perfil_agregar']                                                                = "index/perfil_agregar";
$route['perfil-contrasena']                                                             = "index/perfil_contrasena";
$route['perfil-editar']                                                                 = "index/perfil_editar";
$route['perfil_actualizar']                                                             = "index/perfil_actualizar";
$route['foto']                                                                          = "index/foto";

$route['paciente/(:any)-(:any)']                                                        = "index/paciente/$1_$2";

/**
* Un controlador con 4 metodos
**/
$route['(:any)/(:any)-(:any)-(:any)-(:any)/(:num)/(:num)/(:num)'] = "$1/$2_$3_$4_$5/$6/$7/$8";
$route['(:any)/(:any)-(:any)-(:any)-(:any)/(:num)/(:num)']        = "$1/$2_$3_$4_$5/$6/$7";
$route['(:any)/(:any)-(:any)-(:any)-(:any)/(:num)']               = "$1/$2_$3_$4_$5/$6";
$route['(:any)/(:any)-(:any)-(:any)-(:any)']                      = "$1/$2_$3_$4_$5";

/**
* Un controlador con 3 metodos
**/
$route['(:any)/(:any)-(:any)-(:any)/(:num)/(:num)/(:num)'] = "$1/$2_$3_$4/$5/$6/$7";
$route['(:any)/(:any)-(:any)-(:any)/(:num)/(:num)']        = "$1/$2_$3_$4/$5/$6";
$route['(:any)/(:any)-(:any)-(:any)/(:num)']               = "$1/$2_$3_$4/$5";
$route['(:any)/(:any)-(:any)-(:any)']                      = "$1/$2_$3_$4";

/**
* Un controlador con 2 metodos
**/
$route['(:any)/(:any)-(:any)/(:num)/(:num)/(:num)'] = "$1/$2_$3/$4/$5/$6";
$route['(:any)/(:any)-(:any)/(:num)/(:num)']        = "$1/$2_$3/$4/$5";
$route['(:any)/(:any)-(:any)/(:num)']               = "$1/$2_$3/$4";
$route['(:any)/(:any)-(:any)']                      = "$1/$2_$3";

/**
* 1 Controlador con 1 metodo y metodos compuestos
**/
$route['(:any)/(:any)/(:num)/(:num)/(:num)'] = "$1/$2/$3/$4/$5";
$route['(:any)/(:any)/(:num)/(:num)']        = "$1/$2/$3/$4";
$route['(:any)/(:any)/(:num)']               = "$1/$2/$3";
$route['(:any)/(:any)']                      = "$1/$2";


/* End of file routes.php */
/* Location: ./application/config/routes.php */