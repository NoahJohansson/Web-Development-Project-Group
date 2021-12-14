function validateForm()
{
    var fNameCorrect = document.forms["form"]["fname"].value;
    var lNameCorrect = document.forms["form"]["lname"].value;

    if (fNameCorrect.trim() === "")
    {
        alert("Förnamn måste fyllas i.");
        return false;
    }
    else if (lNameCorrect.trim() === "")
    {
        alert("Efternamn måste fyllas i.");
        return false;
    }
}

function removePost(postID, forumName){
    data = {postID: postID}
        $.post('include/models/post-process.php', data, function(data){
            data= {forumName : forumName}
            $.post('include/models/post-process.php', data, function(data){
                console.log('#'+forumName+"Content")
                $('#'+forumName+"Content").html(data);
            });
        });

}