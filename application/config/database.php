<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'usuarios';
$active_record = TRUE;
/*--------------------------------------------- */
//$db['usuarios']['hostname'] = 'localhost';
//$db['usuarios']['username'] = 'keypan5_manuel';
//$db['usuarios']['password'] = 'sistema';
/*---------------------------------------------*/
$db['usuarios']['hostname'] = 'localhost';
$db['usuarios']['username'] = 'root';
$db['usuarios']['password'] = '';
/*---------------------------------------------*/
$db['usuarios']['database'] = 'keypan5_permisologia';
$db['usuarios']['dbdriver'] = 'mysqli';
$db['usuarios']['dbprefix'] = '';
$db['usuarios']['pconnect'] = FALSE;
$db['usuarios']['db_debug'] = FALSE;
$db['usuarios']['cache_on'] = FALSE;
$db['usuarios']['cachedir'] = '';
$db['usuarios']['char_set'] = 'utf8';
$db['usuarios']['dbcollat'] = 'utf8_spanish2_ci';
$db['usuarios']['swap_pre'] = '';
$db['usuarios']['autoinit'] = TRUE;
$db['usuarios']['stricton'] = FALSE;

/*---------------------------------------------*/
//$db['aplicacion']['hostname'] = 'localhost';
//$db['aplicacion']['username'] = 'keypan5_manuel';
//$db['aplicacion']['password'] = 'sistema';
/*---------------------------------------------*/
$db['aplicacion']['hostname'] = 'localhost';
$db['aplicacion']['username'] = 'root';
$db['aplicacion']['password'] = '';
/*---------------------------------------------*/
$db['aplicacion']['database'] = 'keypan5_doctores_aplicacion';
$db['aplicacion']['dbdriver'] = 'mysqli';
$db['aplicacion']['dbprefix'] = '';
$db['aplicacion']['pconnect'] = FALSE;
$db['aplicacion']['db_debug'] = FALSE;
$db['aplicacion']['cache_on'] = FALSE;
$db['aplicacion']['cachedir'] = '';
$db['aplicacion']['char_set'] = 'utf8';
$db['aplicacion']['dbcollat'] = 'utf8_spanish2_ci';
$db['aplicacion']['swap_pre'] = '';
$db['aplicacion']['autoinit'] = TRUE;
$db['aplicacion']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */