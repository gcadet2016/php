<!DOCTYPE html>
<html>
  <head>
    <title>Simple Audio Player</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/audio.css">
    <script src="./js/audio.js"></script>
  </head>
  <body>

    <div id="containerMain">
      <img id="img" src="./img/bonjour.jpg" alt="Tedaak"/>
      
      <div id="audioContainer">
        <!-- (A) AUDIO TAG -->
        <audio id="audioCtrl" controls></audio>

        <!-- (B) PLAYLIST -->
        <div id="audioList" ><?php
          // (B1) GET ALL SONGS
          $songs = glob("audio/*.{mp3,webm,ogg,wav}", GLOB_BRACE);

          // (B2) OUTPUT SONGS IN <DIV>
          if (is_array($songs)) { foreach ($songs as $k=>$s) {
            $name = basename($s);
            printf("<div data-src='%s' class='song'>%s</div>", rawurlencode($name), $name);
          }} else { echo "No songs found!"; }
        ?></div>
      </div>
  </div></body>
</html>