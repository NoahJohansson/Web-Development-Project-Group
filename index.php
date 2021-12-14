<!-- 
    TODO
    Databasens path måste just nu sättas till en absolut. borde se över.
    Hitta APIer
    Ranker på användare
    Sökfunktion

    KLART
    Fixa login
    Fixa Register
    Hämta posts
    collapseble blir fel storlek första gången
    posta inlägg


-->
<!DOCTYPE html>
<?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $_SESSION['databaseFilePath'] = 'sqlite:C:\wamp64\www\PG18\db\PG18_db.db';
        }
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
        <script src="js/headerHandler.js"></script>
        <script src="js/changePage.js"></script>
        <script src="js/js.js"></script>
        <script src="js/beerLocator.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   

    </head>
    
    <body>
        <?php require_once("./include/views/header.php");?>
        <div>
            
            <div id="main">
                <?php 
                 require_once("./include/views/index.php");

                 ?>
            </div>
        </div>
    </body>
</html>