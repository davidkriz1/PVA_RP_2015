<?php
  require_once("../core/core.php");
?>
<!DOCTYPE HTML>
<html>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link type="text/css" href="css/default.css" rel="stylesheet">
  <link type="text/css" href="css/aligner.css" rel="stylesheet">
  <script src="../libs/js/jquery-2.1.3.min.js" type="text/javascript"></script>
  <script src="../libs/js/jquery-ui.min.js" type="text/javascript"></script>
  <title></title>
  </head>
  <body>
    <div id="page">
      <div id="main">
        <div id="menu">
          <a href="index.php?page=home">Domů</a>
          <a href="index.php?page=training">Cvičiště</a>
          <a href="index.php?page=trader">Obchodník</a>
          <a href="index.php?page=clan">Klan</a>
          <a href="index.php?page=halloffame">Síň slávy</a>
          <a href="index.php?page=work">Práce</a>         
          <a href="index.php?page=expedition">Výprava</a>
          <a href="#">Odhlásit</a>
        </div>
        <div id="bodydiv">
          <div class="informationdiv"></div>
          <div id="content">
            <?php
            $page = empty($_GET["page"]) || !isset($_GET["page"]) ? "home" : system::osetri_get($_GET["page"]);  
            
            if(file_exists("page/".$page.".php"))
            {
              include_once("page/".$page.".php");
            }
            else
            {
            ?>
            <div class="error" class="Aligner-item">
            Tato stránka neexistuje!
            </div>
            <?php
            } 
            ?>
          </div>
          <div class="informationdiv"></div>
        </div>        
        <div id="footer">Davvve & Sognus © 2015</div>
      </div>
    </div>
  </body>
</html>
