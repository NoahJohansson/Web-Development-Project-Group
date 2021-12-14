<?php
if(isset($_POST["email"]) && isset($_POST["password"])){
    loginUser($_POST["email"] , $_POST["password"]);
}
function loginUser($email, $password){
    
        // Validate password
        if(empty(trim($password))){
            $errors["password"] = "Skriv in ditt lösenord </br>";     
        }
        //validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors["email"] = "Emailadressen är icke i korrekt format <br>";
        }

        if(empty($errors)){
            //Input is correctly formated
            try{
                session_start();
                
                $dbfp = $_SESSION["databaseFilePath"];
                $db = new PDO($dbfp); //här
                
                $results = $db->query("SELECT * FROM users WHERE email ='{$email}' ");
                $row = $results -> fetch(PDO::FETCH_ASSOC);

                if(!empty($row)){
                    //User is registerd
                    $hashedComparePassword = $row["salt"] . $password;
                    if(password_verify($hashedComparePassword, $row["hashedPassword"])){
                        //Correct password
                        $_SESSION["username"] = $row["userName"];
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["userID"] = $row["userID"];
                        $_SESSION["userLevel"] = $row["userLevel"];
                        echo '<script language="javascript">';
                        echo 'alert("Inloggningen lyckades!'.$_SESSION["userLevel"].$row["userLevel"] .'")';
                        echo '</script>';
                        echo '<script language="javascript">';
                        echo 'location.reload()';
                        echo '</script>';

                    }
                    else{
                        $errors["password"] = "Fel lösenord <br>";
                    }
                }
                else{
                    $errors["email"] = "Emailadressen är inte registrerad";
                }
                
                
            }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
        } 
    if(isset($errors)){
        foreach($errors as $error){
            echo $error;
        }
    }
        
    }

    function isLoggedIn(){
        if(!isset($_SESSION["username"])){
            return false;
        }
        else{
            return true;
        }
    }
    