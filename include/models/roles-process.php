<?php
session_start();
if(isset($_POST['email']) && isset($_POST['userLevel']) && $_SESSION['userLevel'] == "ADMIN"){
    setRole($_POST['email'], $_POST['userLevel']);
}


function setRole($email, $userLevel){
    $db = new PDO('sqlite:C:\wamp64\www\PG18\db\PG18_db.db');
    $stmt = $db->prepare("UPDATE users
    SET userLevel = :userLevel
    WHERE email = :email");

    $stmt->bindparam(':userLevel', $userLevel);
    $stmt->bindparam(':email', $email);
    $stmt->execute();
    echo($email . $userLevel);
    echo("Användarens roll har ändrats");
}

?>