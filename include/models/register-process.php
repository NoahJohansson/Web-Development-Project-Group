<?php
if($_POST){

    if(isset($_POST["email"]) && isset($_POST["password"])  && isset($_POST["username"])){
        registerUser($_POST["username"] , $_POST["email"], $_POST["password"]);

    }
}
    function registerUser($username, $email, $password){
        $errors = array();
        // Validate username
        if(empty(trim($username))){
            $errors["name"] = "Skriv in ditt användarnamn.<br>";
        }  
        // Validate password
        if(empty(trim($password))){
            $errors["password"] = "Skriv in ditt lösenord.<br>";     
        }
        //validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors["email"] = "Emailadressen är icke i korrekt format.";
        }
        //ändrade db-länken så den borde fungera för alla
        session_start();
        $dbfp = $_SESSION["databaseFilePath"];
        $db = new PDO($dbfp);

        $results = $db->query("SELECT email FROM users WHERE email ='{$_POST["email"]}' ");
        $row = $results -> fetch(PDO::FETCH_ASSOC);
    
        if(!empty($row)){
            $errors["oldEmail"] = "Emailadressen är redan registrerad";
        }
                
        if(empty($errors)){
            try{
                $db->query(
                    "CREATE TABLE IF NOT EXISTS users(
                    userID INTEGER PRIMARY KEY AUTOINCREMENT,
                    userName TEXT,  
                    email TEXT,
                    hashedPassword TEXT,
                    salt TEXT,
                    userLevel TEXT)");
                $salt = substr(sha1(mt_rand()),0,22);
                $hashedPassword = password_hash($salt . $password, PASSWORD_DEFAULT);
                
                $stmt = $db->prepare(
                    "INSERT INTO users(userName, email, hashedPassword, salt)
                    VALUES(:username, :email, :hashedpassword, :salt)");

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':hashedpassword', $hashedPassword);
                $stmt->bindParam(':salt', $salt);
                $stmt->execute();

                echo '<script language="javascript">';
                    echo 'alert("Registreringen lyckades! Du kan nu logga in...");';
                    echo 'changePage("login")';
                echo '</script>';
                exit();
                
            }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
        }
        else{
            foreach($errors as $error){
                echo $error;
            }
        } 
    }

    ?>