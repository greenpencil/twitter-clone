<?php
require_once (__DIR__ . "/vendor/autoload.php");
date_default_timezone_set('Europe/London');
$view = new stdClass();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}