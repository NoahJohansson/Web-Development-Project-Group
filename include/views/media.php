<script>changeActive("media") </script>


<div id="mediaContent">
    <div class="vidPlayer" id="player1"></div>
    <div class="vidPlayer" id="player2"></div>
    <div class="vidPlayer" id="player3"></div>
    <div class="vidPlayer" id="player4"></div>
</div>
    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player1;
      var player2;
      var player3;
      var player4;
      function onYouTubeIframeAPIReady() {
        player1 = new YT.Player('player1', {
          height: '390',
          width: '640',
          videoId: 'cHOuHK55KR4',
        });
        player2 = new YT.Player('player2', {
          height: '390',
          width: '640',
          videoId: 'iDR82qG5uzs',
        });
        player3 = new YT.Player('player3', {
          height: '390',
          width: '640',
          videoId: '2nORwQ6q8hw',
        });
        player4 = new YT.Player('player4', {
          height: '390',
          width: '640',
          videoId: 'Wr69bnB86d0',
        });
      }

      
      function stopVideo() {
        player.stopVideo();
      }
    </script>