<script>changeActive("profile")</script>
<?php
        if(!isset($_SESSION["userLevl"])){
        session_start();
        }
        if($_SESSION["userLevel"]  != "ADMIN"){
            echo '<script language="javascript">';
            echo 'alert("Lite skydd har vi iallfall");';
            echo 'changePage("index");';
            echo '</script>';
            exit();
        }
?>
<div class="greyBoxDiv">
    <div class="formHeader">
            <h3 id="postHeader">Ändra Roller</h3>
    </div>
    <form id="roleSetter">
        <label for="email">Email på användaren</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="lname">Användarnivå</label><br>
        <input type="userLevel" id="userLevel" name="userLevel"><br><br>
        <input type="submit" value="Submit">
    </form> 
    <div id="errors"></div>
</div>



<script>
     $(document).ready(function(){
            $('#roleSetter').submit(function(event){
                event.preventDefault();
                var email = $('#email').val();
                var userLevel = $('#userLevel').val();
                data = {
                    email: email,
                    userLevel: userLevel
                }
                // Process AJAX request
                $.post('include/models/roles-process.php', data, function(data){
                // Append data into #results div
                    $('#errors').html(data);
                });
            });
        });
</script>