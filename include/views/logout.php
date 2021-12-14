<script>changeActive("logout") </script>

<p>Du har blivit utloggad</p>

<?php
try{
    session_start();
    $_SESSION = array();
    session_destroy();
    echo '<script language="javascript">';
    echo 'alert("Du har loggats ut")';
    echo '</script>';
    echo '<script language="javascript">';
    echo 'location.reload();';
    echo '</script>';
    echo '<script language="javascript">';
    echo 'changePage("login");';
    echo '</script>';
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>