<?php
    session_start();

    

    if(isset($_POST["forumName"]) && isset($_POST["input"]) && isset($_SESSION["userID"])){
        newPost($_POST["forumName"],  $_POST["input"], $_SESSION["userID"]);  
        $_POST = [];
    }
    elseif(isset($_POST["forumName"])){
        getPosts($_POST["forumName"]);
    }
    elseif(isset($_POST["postID"]) && $_SESSION["userLevel"] == "ADMIN"){
        removePost($_POST["postID"]);
    }

    function getPosts($thread){

        echo '  
        <input type="text" id="searchform" placeholder="Sök efter inlägg.." title="Skriv in något">
        <input type="submit" value="Sök" onclick=SearchPosts("'.$thread.'")>
        <div id="commentsection">
        </div>
        ';

        $count = 0;
        if(isset($_SESSION["userID"]) && $thread != "Uppdateringar"){
            $button = "<button id=\"" .$_POST["forumName"] ."Button\" onclick=\"postInForum('" . $_POST["forumName"] ."')\" class='postButton'> Posta i detta underforum" . "</button>"; 
            echo( $button. "<br><br>");
    
        }
        elseif($_SESSION["userLevel"] == "ADMIN" && isset($_SESSION["userID"]) && $thread == "Uppdateringar"){
            $button = "<button id=\"" .$_POST["forumName"] ."Button\" onclick=\"postInForum('" . $_POST["forumName"] ."')\" class='postButton'> Posta i detta underforum" . "</button>"; 
            echo( $button. "<br><br>");
        }


        echo("<div id='post". $_POST["forumName"] ."FormDiv'> </div>");
        $dbfp = $_SESSION['databaseFilePath'];
        $db = new PDO($dbfp);



        $results = $db->query("SELECT postID, postContent, postDate, categoryName, userName FROM posts,users WHERE categoryName = '{$thread}' AND posts.userID = users.userID ORDER BY postID desc");
        $results2 = $db->query("SELECT postID, postContent, postDate, categoryName, userName FROM posts,users WHERE categoryName = '{$thread}' AND posts.userID = users.userID ORDER BY postID desc");

        if(isset($_POST["search"])){
            $search = "%".$_POST["search"]."%";
            $results = $db->query("SELECT postID, postContent, postDate, categoryName, userName FROM posts,users WHERE
             categoryName = '{$thread}' AND posts.userID = users.userID  AND (postContent LIKE '{$search}' OR userName LIKE '{$search}') ORDER BY postID desc");
            $results2 = $db->query("SELECT postID, postContent, postDate, categoryName, userName FROM posts,users WHERE
             categoryName = '{$thread}' AND posts.userID = users.userID AND (postContent LIKE '{$search}' OR userName LIKE '{$search}') ORDER BY postID desc");
        }
       
        while ($row2 = $results2->fetch(PDO::FETCH_ASSOC)){ 
            $count++;
        }
        if($count == 0){
            echo("Tyvärr finns det ingen post som matchar den sökningen");
        }
        while ($row = $results->fetch(PDO::FETCH_ASSOC)){ 
            echo "<div class='posts' style='white-space: pre-line'>";
            if($count > 1)
            {
                echo "<div class='postswithborder'>";
            }
            echo $row["userName"];
            echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
            echo $row["postDate"];
            if($_SESSION["userLevel"] == "ADMIN"){
                echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
                echo "<a href='#' onclick=\"removePost('" . $row["postID"] . "','". $thread . "')\">Ta bort denna post</a>";
            }
            echo "<br>";
            echo "---";
            echo "<br>";
            echo $row["postContent"];
            echo "<br>";
            if($count > 1)
            {
                echo "</div>";
            }
            $count--;
            echo "</div>";
        }
        
    }

    function newPost($thread, $input, $userID){
        $db = new PDO('sqlite:C:\wamp64\www\PG18\db\PG18_db.db');
        $date = date("Y-m-d");
        $stmt = $db->prepare("INSERT INTO posts (postContent, postDate, categoryName, userID)
                VALUES (:postContent, :postDate, :categoryName, :userID)");
                
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':postContent', $input);
        $stmt->bindParam(':categoryName', $thread);
        $stmt->bindParam('postDate', $date);


        $stmt->execute();
    }

    function removePost($postID){
        $postID = trim($postID);
        $db = new PDO('sqlite:C:\wamp64\www\PG18\db\PG18_db.db');
        $db->query("DELETE FROM posts WHERE postID = '{$postID}'");
    }
?>