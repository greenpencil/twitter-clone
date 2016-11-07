<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 06/11/2016
 * Time: 23:57
 */

namespace Twitter\Database;

use Twitter\User;

class UsersTable extends TableAbstract
{

    protected $name = 'users';
    protected $primaryKey = 'id';

    function fetchAllUsers()
    {
        $results = $this->fetchAll();
        $userArray = array();
        while ($row = $results->fetch()) {
            $userArray[] = new User($row);
        }
        return $userArray;
    }

    function fetchUserByID($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newUser = NULL;
        if($row) {
            $newUser = new User($row);
        }
        return $newUser;
    }

    function addNewUser($data)
    {
        $password = password_hash($data['password'], PASSWORD_BCRYPT );

        $sql = 'INSERT INTO '. $this->name .' (username, password, email) VALUES (:username, :password, :email)';
        $result = $this->dbHandler->prepare($sql);
        $result->execute(array(
            ':username' => $data['username'],
            ':password' => $password,
            ':email' => $data['email']
        ));
        echo $this->dbHandler->lastInsertId();
        return $this->dbHandler->lastInsertId();
    }

}