<script>changeActive("login")</script>


<script>
        $(document).ready(function(){
            $('#loginForm').submit(function(event){
                event.preventDefault();
                var email = $('#email').val();
                var password = $('#password').val();
                data = {
                    email: email,
                    password: password
                }
                // Process AJAX request
                $.post('include/models/login-process.php', data, function(data){
                // Append data into #results div
                    $('#errors').html(data);
                });
            });
        });
</script>

<div id="loginDiv" class="formDiv">
            <div class="formHeader">
                <h3>Logga in</h3>
            </div>
            <form class="regForm" id="loginForm" method="post" onsubmit="return validateLoginForm()">
                <label for="email">Emailadress:</label><br>
                <input type="text" id="email" name="email"><br>
                <label for="password">Lösenord:</label><br>
                <input type="password" id="password" name="password"></textarea><br><br>
                <input type="submit" value="Logga in">
            </form>
        <div id="errors">
    </div>
</div>