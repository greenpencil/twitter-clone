<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 06/11/2016
 * Time: 23:51
 */

namespace Twitter;


use Twitter\Database\UsersTable;

class Tweet
{

    public $id;
    public $content;
    public $reply_to;
    public $user;
    public $timestamp;

    /**
     * Tweet constructor.
     * Takes a argument of the DATABASE ROW
     */
    public function __construct($row)
    {
        $this->id = $row['id'];
        $this->content = $row['content'];
        $this->reply_to = $row['reply_to'];
        $this->timestamp = $row['timestamp'];
        
        $usersTable = new UsersTable();
        $this->user = $usersTable->fetchUserByID($row['user_id']);
    }


}