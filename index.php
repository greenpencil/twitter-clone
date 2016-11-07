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
        $data = array(
            "content" =>  $_POST['message'],
            "user_id" => $_SESSION['user']
        );
        $tweetsTable->addNewTweet($data);
    }

    // right now you follow everyone
    $view->tweets = $tweetsTable->fetchAllTweetByTime();

    // code for only getting tweets from followers
    $following_ids = array(1, 2 ,8);
    $tweetsTable->fetchAllTweetByTimeByUserIdArray($following_ids);

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
            //var_dump($usersTable->fetchUserByUsername($data['username']));
            $user_id = $usersTable->fetchUserByUsername($data['username'])->id;
            $_SESSION['user'] = $user_id;
        } else {
            echo 'error';
        }
    }
    require_once ("views/newAccount.phtml");
}