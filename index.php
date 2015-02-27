<?php
  require_once("core/core.php");
?>

<!DOCTYPE HTML>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link type="text/css" href="css/default.css" rel="stylesheet">
  <link type="text/css" href="css/aligner.css" rel="stylesheet">
  <script src="libs/js/jquery-2.1.3.min.js" type="text/javascript"></script>
  <script src="libs/js/jquery-ui.min.js" type="text/javascript"></script>
  <title></title>
  </head>
  <body>
    <div id="page" class="Aligner">
      <div id="main" class="Aligner-item">
        <div id="menu">
          <a href="index.php">Domů</a>
          <a href="index.php?page=register">Registrace</a>
          <a href="index.php?page=contacts">Kontakty</a>
          <a href="index.php?page=screens">Screeny</a>
        </div>
        <?php
        if(isset($e) && !empty($e))
        {
        ?>
        <div id="errordiv" class="Aligner">
          <?php echo $e;?>
        </div>
        <?php
        }
        ?>
        <div id="content" class="Aligner">
          <?php
            $page = empty($_GET["page"]) || !isset($_GET["page"]) ? "login" : system::osetri_get($_GET["page"]);
            
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
      </div>
    </div>
  </body>
</html>
