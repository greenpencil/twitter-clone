<?php
require_once ("header.php");

$view->title = "Twitter";

$usersTable = new \Twitter\Database\UsersTable();
$tweetsTable = new \Twitter\Database\TweetsTable();

if(isset($_POST['message']))
{
    $tweetsTable->addNewTweet($_POST['message']);
}

//var_dump($usersTable->fetchAllUsers());
var_dump($tweetsTable->fetchAllTweets());

require_once ("views/index.phtml");