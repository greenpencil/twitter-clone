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

    function fetchAllTweetByTime()
    {
        $sql = 'SELECT * FROM '. $this->name .'  ORDER BY `timestamp` DESC';
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
        $tweetsArray = array();
        while ($row = $results->fetch()) {
            $tweetsArray[] = new Tweet($row);
        }
        return $tweetsArray;
    }

    function fetchAllTweetByTimeByUserIdArray($userIds)
    {
        $str = "";
        $i = 0;
        foreach ($userIds as $userId)
        {
            if($i == 0)
            {
                $str = $str . " user_id=" . $userId ;
            } else {
                $str = $str . " OR " . " user_id=" . $userId ;
            }
            $i++;
        }
        $sql = 'SELECT * FROM '. $this->name . " WHERE " . $str. '  ORDER BY `timestamp` DESC';
        echo $sql;
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

    function addNewTweet($data)
    {
        $phptime = new \DateTime();
        $mysql = $phptime->format("Y-m-d H:i:s");
        $sql = 'INSERT INTO '. $this->name .' (content, reply_to, user_id, timestamp) VALUES (:content, :reply_to, :user_id, :timestamp)';
        $result = $this->dbHandler->prepare($sql);
        $result->execute(array(
            ':content' => $data["content"],
            ':reply_to' => null,
            ':user_id' => $data['user_id'],
            ':timestamp' => $mysql
        ));
        return $this->dbHandler->lastInsertId();
    }

}