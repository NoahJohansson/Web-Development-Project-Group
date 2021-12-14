<?php

function getPosts($thread){
    $db = new PDO('sqlite:C:\wamp64\www\PG18\db\PG18_db.db');
    $results = $db->query("SELECT * FROM posts WHERE categoryName = $thread ORDER BY postID desc");
    while ($row = $results->fetchArray()){
        echo $row["email"];
        echo "<br>";
        echo "---";
        echo "<br>";
        echo $row["comment"];
        echo "<br>";
    }
}

?>