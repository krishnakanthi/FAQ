<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include('environment.php');
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




$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'iboomerang_db';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = FALSE;
$db['default']['stricton'] = FALSE;

$db['QA']['hostname'] = '10.0.10.251';
$db['QA']['username'] = 'website';
$db['QA']['password'] = 'LfEyzKxdQurnKhdt';
$db['QA']['database'] = 'iboomerang_db';
$db['QA']['dbdriver'] = 'mysql';
$db['QA']['dbprefix'] = '';
$db['QA']['pconnect'] = FALSE;
$db['QA']['db_debug'] = FALSE;
$db['QA']['cache_on'] = FALSE;
$db['QA']['cachedir'] = '';
$db['QA']['char_set'] = 'utf8';
$db['QA']['dbcollat'] = 'utf8_general_ci';
$db['QA']['swap_pre'] = '';
$db['QA']['autoinit'] = FALSE;
$db['QA']['stricton'] = FALSE;

$db['agency']['hostname'] = 'localhost';
$db['agency']['username'] = 'root';
$db['agency']['password'] = '';
$db['agency']['database'] = 'agency';
$db['agency']['dbdriver'] = 'mysql';
$db['agency']['dbprefix'] = '';
$db['agency']['pconnect'] = FALSE;
$db['agency']['db_debug'] = FALSE;
$db['agency']['cache_on'] = FALSE;
$db['agency']['cachedir'] = '';
$db['agency']['char_set'] = 'utf8';
$db['agency']['dbcollat'] = 'utf8_general_ci';
$db['agency']['swap_pre'] = '';
$db['agency']['autoinit'] = FALSE;
$db['agency']['stricton'] = FALSE;

//Used for images accessability
$db['images']['hostname'] = '10.0.10.11';
$db['images']['username'] = 'website';
$db['images']['password'] = 'LfEyzKxdQurnKhdt';
$db['images']['database'] = 'iboomerang_db';
$db['images']['dbdriver'] = 'mysql';
$db['images']['dbprefix'] = '';
$db['images']['pconnect'] = FALSE;
$db['images']['db_debug'] = FALSE;
$db['images']['cache_on'] = FALSE;
$db['images']['cachedir'] = '';
$db['images']['char_set'] = 'utf8';
$db['images']['dbcollat'] = 'utf8_general_ci';
$db['images']['swap_pre'] = '';
$db['images']['autoinit'] = FALSE;
$db['images']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
