<?php
use Front\FrontController;

require_once('app/config.php');
require_once('app/autoload.php');
require 'vendor/autoload.php';
/**
 * Instanciation de la classe d'auto chargement,
 * Permettant de charger les classes
 */
$autoloader = new Autoloader();
/**
 * Do not touch this session_start position
 */
session_start();
/**
 * Launtching the application
 */
$app = new FrontController();
$app->run();
