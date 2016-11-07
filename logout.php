<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 07/11/2016
 * Time: 01:16
 */

include_once ("header.php");

session_destroy();
header('Location: index.php');