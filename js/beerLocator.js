function beerSearch(search){
    $.getJSON("https://bolaget.io/products/?limit=20&name="+search+"&product_group=öl",  function(data){
        var beerLinks;
        $.each(data, function(i, item) {
                var name = item.name.toLowerCase() + "-";
                name = name.replace(/\s/g, '-');
                name = name.replace(/å/g, 'a');
                name = name.replace(/ä/g, 'a');
                name = name.replace(/ö/g, 'o');

                var price_per_liter = item.price_per_liter;
                var alcohol = item.alcohol.replace("%", "");
                var apk = alcohol/price_per_liter;
                var origin = item.origin;
                if(origin == null){
                    origin = item.origin_country;
                }
                console.log(item);
                //beerLinks = beerLinks + " <a href='https://www.systembolaget.se/dryck/ol/" + name +item.nr+ "'>"+ item.name +" apk: "+ apk + "</a><br>";
                beerLinks = beerLinks + " <a href='#'' onclick='addMarker(\"" + origin + "\",\""+name +"\")'>" +item.name +"</a><br>";
                beerLinks.replace("undefined", "");
            });
            $("#beerList").html(beerLinks);
    });


}

function beerSearchInput(){
    searchInput = $("#searchInput").val();
    beerSearch(searchInput);
}

function addMarker(place, beerName){
    var location;
    var latitude;
    var longitude;
    var address = place;

    var geocoder = new google.maps.Geocoder();

    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        latitude = results[0].geometry.location.lat();
        longitude = results[0].geometry.location.lng();
        console.log(latitude + "   " +  longitude)
        
        marker = new google.maps.Marker({
          position: {lat: latitude, lng: longitude},
          map: map,
          title: beerName,
          animation: google.maps.Animation.DROP
        }); 
        
      } 
    });          
  }