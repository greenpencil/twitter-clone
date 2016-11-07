<?php
require_once ("header.php");

$view->title = "Twitter";

$usersTable = new \Twitter\Database\UsersTable();
$tweetsTable = new \Twitter\Database\TweetsTable();

//session_destroy();
//var_dump($usersTable->fetchAllUsers());
//var_dump($tweetsTable->fetchAllTweets());

if(isset($_SESSION['user'])) {
    if(isset($_POST['message']))
    {
        $tweetsTable->addNewTweet($_POST['message']);
    }
    require_once("views/index.phtml");
} else {
    if(isset($_POST['register'])) {
        $data = array(
          "username" => $_POST['username'],
          "password" => $_POST['password'],
          "email" => $_POST['email']
        );

        $user_id = $usersTable->addNewUser($data);
        $_SESSION['user'] = $user_id;
        header('Location: index.php');
    } elseif (isset($_POST['login']))
    {
        $data = array(
            "username" => $_POST['username'],
            "password" => $_POST['password']
        );

        $login = $usersTable->login($data);

        if($login === true)
        {
            $user_id = $usersTable->fetchUserByUsername($data['username'])->id;
            $_SESSION['user'] = $user_id;
        } else {
            echo 'error';
        }
    }
    require_once ("views/newAccount.phtml");
}