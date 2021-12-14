<script>changeActive("index")</script>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/PG18/css/stylesheet.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<button class="collapsible">Bryggerier</button>
    <div class="content" id="BryggerierContent"></div>
<button class="collapsible">Ölsorter</button>
    <div class="content" id="ÖlsorterContent"></div>
<button class="collapsible">Hembryggeri</button>
    <div class="content" id="HembryggeriContent"></div>
<button class="collapsible" >Pubar</button>
    <div class="content" id="PubarContent"></div>
<button class="collapsible">Uppdateringar</button>
    <div class="content" id="UppdateringarContent"></div>

<br>


<div id="beerlist"></div>

<script>

function SearchPosts(forumName) //called when pressing enter on searchbar
{
    search = $("#searchform").val();
    console.log(search);
    data = {
        forumName : forumName,
        search : search
    }
    
    $.post('include/models/post-process.php', data, function(data){
                // Append data into #results div
                $('#'+forumName+"Content").html(data);

    });

   
}

$('#submissionForm').submit(function(event){
    event.preventDefault();
    var input = $('#input').val();
    var forumName = $("#submissionForm").attr("forumName");
    data = {
        input: input,
        forumName : forumName
    }
    // Process AJAX request
    $.post("include/models/post-process.php", data, function(data){
        console.log("första");
        $('#'+forumName+"Content").html(data);
    });
    
    var data = {
        forumName : forumName
    }

    $.post('include/models/post-process.php', data, function(data){
            console.log("andra")
            $('#'+forumName+"Content").html(data);
        });
});


var coll = document.getElementsByClassName("collapsible");

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("mousedown", function() {
        var forumName = $(this).text();
        data = {forumName: forumName}
        $.post('include/models/post-process.php', data, function(data){
            console.log('#'+forumName+"Content")
            $('#'+forumName+"Content").html(data);
        });
    });
}

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
    this.classList.toggle("active2");
    var content = this.nextElementSibling;
    console.log(content.scrollHeight)
    
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {

      content.style.maxHeight = 10000000 + "px";
    } 
  });
}

    function postInForum(forumName){
        $("form").each(function() {
            $(this).remove();
        })

        $("#post"+forumName+"FormDiv").load("include/views/postForm.php")
        $("#post"+forumName+"FormDiv").attr("forumName", forumName);
        
        $("#"+forumName+"Button").remove();
    }

</script>

</body>
</html>