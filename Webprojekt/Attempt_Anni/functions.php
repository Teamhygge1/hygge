<?php

require_once "datenbank.php";

function add_post($userid,$body){
    $sql = "insert into posts2 (user_id, body, stamp) 
            values ($userid, '". mysqli_real_escape_string($body). "',now())";

    $result = mysqli_query($sql);
}

// Funktion um Inhalte in die Posts Tabelle zu schreiben


function show_posts($userid,$limit=0){
    $posts = array();

  //  $user_string = implode(',', $userid);
   //  $extra =  " and id in ($user_string)";

    if ($limit > 0){
        $extra = "limit $limit";
    }else{
        $extra = '';
    }

    $sql = "SELECT user_id,body, stamp FROM posts2 
        WHERE user_id in ($user_string) 
        order by stamp desc $extra";
    echo $sql;
    $result = mysqli_query($sql);

    while($data = mysqli_fetch_object($result)){
        $posts[] = array(   'stamp' => $data->stamp,
            'userid' => $data->user_id,
            'body' => $data->body
        );
    }
    return $posts;

}

function show_users($user_id=0){

    if ($user_id > 0){
        $follow = array();
        $fsql = "select user_id from following
                where follower_id='$user_id'";
        $fresult = mysqli_query($fsql);

        while($f = mysqli_fetch_object($fresult)){
            array_push($follow, $f->user_id);
        }

        if (count($follow)){
            $id_string = implode(',', $follow);
            $extra =  " and id in ($id_string)";

        }else{
            return array();
        }

    }

    $users = array();
    $sql = "select id, username from users2 
        where status='active' 
        $extra order by username";


    $result = mysqli_query($sql);

    while ($data = mysqli_fetch_object($result)){
        $users[$data->id] = $data->username;
    }
    return $users;
}









?>