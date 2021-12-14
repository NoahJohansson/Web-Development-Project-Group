<div id="submissionFormDiv" class = "postForm">
    <form id="submissionForm" method="post" onsubmit="">
        <label for="input">Inlägget:</label><br>
        <textarea class = "submissionfield" type="text" id="input" name="input"></textarea><br><br>
        <input type="submit" value="Skicka in">
        <div id="errors">
        </div>
    </form>
</div>

<script>
$('#submissionForm').submit(function(event){
    event.preventDefault();
    var forumName = $('#submissionForm').parent().parent().attr("forumName");
    console.log(forumName)
    var input = $('#input').val();
    data = {
        input: input,
        forumName : forumName
    }
    // Process AJAX request
    $.post("include/models/post-process.php", data, function(data){
        data = {
            forumName : forumName
        }
        $.post("include/models/post-process.php", data, function(data){
            $('#'+forumName+"Content").html(data);
         });
    });
});
</script>