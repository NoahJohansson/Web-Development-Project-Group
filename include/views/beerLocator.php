<script>changeActive("beerLocator")</script>


    <!--The div element for the map -->
    <div id="beerLocatorDiv">
      <div id="map"></div>
      <div id="searchDiv">
        <input type="text" id="searchInput" onkeyup="beerSearchInput()" placeholder="Sök efter öl..." title="Öllokerare">
        <div id="beerList"></div>
      </div>
    </div>



    <script>
      var map;
      var marker;
      
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
        
            center: {lat: 59.858509, lng: 17.642100},
            zoom: 2
        });
        
      }
      
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg2LxGVZ8AXdt3vsH2LqDkOpfZvrUoEqg&callback=initMap" async defer></script>
