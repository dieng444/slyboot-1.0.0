<?php
/******************************************************************************************
 * This file allows you to specify informations about your app configuration.             *
 * Like database informations or other things                                             *
 * NB : For all of the settings below. just specify the value                             *
 * of the constants but not the constant name. Not really touch the name of the constant, *
 * otherwise, it will cause huge dysfunctions in the app.                                 *
 ******************************************************************************************/
define('HOST',' ');
define('USER',' ');
define('PASSWD',' ');
define('DB_NAME',' ');
define('DSN','mysql:host='.HOST.';dbname='.DB_NAME);
/*************************Namespaces infos*************************/
define('SRC_DIR',realpath($_SERVER['DOCUMENT_ROOT'].'src').'/');
define('LIB_DIR',realpath($_SERVER['DOCUMENT_ROOT'].'lib').'/');
define('APP_DIR',realpath($_SERVER['DOCUMENT_ROOT'].'app').'/');

