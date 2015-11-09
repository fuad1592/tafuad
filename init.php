<?php
/*
 * Sistem Informasi Manajemen Review - Politeknik Elektronika Negeri Surabaya
 *
 * @name		Init.php
 * @author		Fuad Nasrudin ()
 */

ob_start();
session_start();

require_once 'Engine/Modul/Modul.php';
$Init = new Procedure;

define('CSS','Assets/css/');
define('CONTENT','Content/');
define('FONT','Assets/fonts/');
define('IMG','Assets/img/');
define('JS','Assets/js/');
