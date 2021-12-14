<?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
?>

<div class="header">
            <div class="header-1">
                <div class="headlogo">
                    <a href="./index.php">
                        <img src="./img/logo.png">
                    </a>
                </div>
            </div>
            <div class="navbar">
                <ul>
                    <li><a id="index" onclick='changePage("index")' href="javascript:;">Forum</a></li>
                    <li><a id="media" onclick='changePage("media")' href="javascript:;">Media</a></li>
                    <li><a id="beerLocator" onclick='changePage("beerLocator")' href="javascript:;">Vart kommer ölen ifrån?</a></li>
                    <?php if(!isset($_SESSION['userID'])): ?>
                        <li style="float:right"><a id="login" onclick='changePage("login")' href="javascript:;">Logga in</a></li>
                    <?php endif; ?>
                    
                    <?php if(!isset($_SESSION['userID'])): ?>
                        <li style="float:right"><a id="register" onclick='changePage("register")' href="javascript:;">Registrera</a></li>
                    <?php endif; ?>
                    
                    <?php if(isset($_SESSION['username'])): ?>
                        <?php if($_SESSION['userLevel'] == "ADMIN"): ?>
                            <li style="float:right"><a id="roles" onclick='changePage("roles")' href="javascript:;">Hantera roller</a></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['username'])): ?>
                        <li style="float:right"><a id="register" onclick='changePage("logout")' href="javascript:;">Logga ut</a></li>
                    <?php endif; ?>

                </ul>
            </div>
</div>