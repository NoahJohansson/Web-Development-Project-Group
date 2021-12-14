<script>changeActive("register")</script>
<script>
        $(document).ready(function(){

            $('#registrationForm').submit(function(event){
                event.preventDefault();

                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val();
                data = {
                    username : username,
                    email: email,
                    password: password
                }
                // Process AJAX request
                $.post('include/models/register-process.php', data, function(data){
                // Append data into #results div
                    $('#errors').html(data);
                });
            });
        });
</script>

<div id="registrationDiv" class="formDiv"> 
    <div class="formHeader">
        <h3>Registrering</h3>
    </div>
    <form class="regForm" id="registrationForm" method="post" onsubmit="return validateRegForm()">
        <label for="name">Användarnamn:</label><br>
        <input type="text" id="username" name="name"><br>
        <label for="email">Emailadress:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">Lösenord:</label><br>
        <input type="password" id="password" name="password"></textarea><br><br>
        <input type="submit" value="Registrera användare">
    </form>
    <div id="errors">
    </div>
</div>