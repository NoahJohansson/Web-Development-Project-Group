function changePage(newpage){
    var body = $("#main");
    newpage = "include/views/"+newpage+".php";
    body.load(newpage);
}