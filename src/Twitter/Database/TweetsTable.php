<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 06/11/2016
 * Time: 23:58
 */

namespace Twitter\Database;

use Twitter\Tweet;

class TweetsTable extends TableAbstract
{
    protected $name = 'tweets';
    protected $primaryKey = 'id';

    function fetchAllTweets()
    {
        $results = $this->fetchAll();
        $tweetsArray = array();
        while ($row = $results->fetch()) {
            $tweetsArray[] = new Tweet($row);
        }
        return $tweetsArray;
    }

    function fetchTweetByID($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newTweet = NULL;
        if($row) {
            $newTweet = new Tweet($row);
        }
        return $newTweet;
    }

    function addNewTweet($content)
    {
        $phptime = new \DateTime();
        $mysql = $phptime->format("Y-m-d H:i:s");
        echo $mysql;
        $sql = 'INSERT INTO '. $this->name .' (content, reply_to, user_id, timestamp) VALUES (:content, :reply_to, :user_id, :timestamp)';
        $result = $this->dbHandler->prepare($sql);
        $result->execute(array(
            ':content' => $content,
            ':reply_to' => null,
            ':user_id' => 1,
            ':timestamp' => $mysql
        ));
        return $this->dbHandler->lastInsertId();
    }

}