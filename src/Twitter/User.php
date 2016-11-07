<?php

/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 06/11/2016
 * Time: 23:51
 */
namespace Twitter;
class User
{
    public $id;
    public $username;
    public $password;
    public $email;

    public $followers;
    public $following;

    /**
     * User constructor.
     */
    public function __construct($row)
    {

        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->email = $row['email'];

        $followers = array();
        $following = array();
    }


}