<?php
/******************************************************************************************
 * This file allows you to specify informations about your app configuration.             *
 * Like database informations or other things                                             *
 * NB : For all of the settings below. just specify the value                             *
 * of the constants but not the constant name. Not really touch the name of the constant, *
 * otherwise, it will cause huge dysfunctions in the app.                                 *
 ******************************************************************************************/
define('host','localhost');
define('USER','dieng444');
define('PASSWD','black');
define('DB_NAME','mini_journal');
define('DSN','mysql:host='.host.';dbname='.DB_NAME);
/***Cette partie sera gérer par composer dans le futur******/
define('SRC_DIR','/home/dieng444/dev/AppDieng/app-dieng/M1DNR2i/Slyboot-1.1.0/src/');
define('LIB_DIR','/home/dieng444/dev/AppDieng/app-dieng/M1DNR2i/Slyboot-1.1.0/lib/');
define('APP_DIR','/home/dieng444/dev/AppDieng/app-dieng/M1DNR2i/Slyboot-1.1.0/app/');


//config fac
/*require_once('../../private/config.php');
define('host','mysql.info.unicaen.fr');
define('port','3306');
define('USER',DB_USER);
define('PASSWD',DB_PASSWD);
define('DB_NAME','21410938_2');
define('DSN','mysql:host='.host.';port='.port.';dbname='.DB_NAME);
define('AppDieng_DIR','/users/21410938/www-dev/TP_journal_PHP_Elhadj_Macky_Dieng_v6/src/');*/
