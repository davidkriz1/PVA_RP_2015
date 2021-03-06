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
      <?php if(!isset($_SESSION["id"])){ system::forceRedirect(); exit();  /*$player = db::getPlayerById($link, $_SESSION["id"]); echo sprintf("Logged as [%d] %s lastvisit=%d (%s)",$player["id"], $player["nick"], $_SESSION["lastvisit"], date("d.m.Y H:i:s", $_SESSION["lastvisit"])); */}  ?>
      <div id="main">
        <div id="menu">
          <a href="index.php?page=home">Domů</a>
          <a href="index.php?page=training">Cvičiště</a>
          <a href="index.php?page=trader">Obchodník</a>
          <a href="index.php?page=clan">Klan</a>
          <a href="index.php?page=halloffame">Síň slávy</a>
          <a href="index.php?page=work">Práce</a>         
          <a href="index.php?page=expedition">Výprava</a>
          <a href="index.php?action=logout">Odhlásit</a>
        </div>
        <div id="bodydiv">
          <div class="informationdiv">
            <?php
            $playerdataassoc = playerdatafunction($link);
            $nick = $playerdataassoc["nick"];
            $level = $playerdataassoc["level"];
            $HPnow = $playerdataassoc["HP"];
            $XPnow = $playerdataassoc["XP"];      
            $strength = $playerdataassoc["strength"];
            $dexterity = $playerdataassoc["dexterity"];
            $stamina = $playerdataassoc["stamina"];  
            $gold = $playerdataassoc["gold"]; 
            $diamond = $playerdataassoc["diamond"];
            
            $HP = ($level * 15) + 50 + ($stamina * 5);
            $XP = ($level * 5) + 10;
            
            if($XPnow > $XP || $XPnow == $XP)
            {
                $level = $level + 1;
                mysqli_query($link, "UPDATE game_users SET level = '" . $level . "' WHERE id = " . $_SESSION['id'] . "");
            }
            ?>
            <div class="currencydiv">
              <div class="currencyimagediv">
                <img src="http://home.spsostrov.cz/~krizda/php/Images/gold.png" class="currencyimage">
              </div>
              <span class="goldcurrencyvaluespan">
                <?php  
                echo($gold);
                ?>
              </span>
            </div>
            <div class="currencydiv">
              <div class="currencyimagediv">
                <img src="http://home.spsostrov.cz/~krizda/php/Images/reddiamond.png" class="currencyimage">
              </div>
              <span class="diamondcurrencyvaluespan">
                <?php  
                echo($diamond);
                ?>
              </span>
            </div>
            <img class="homebarimg" alt="<?php echo($HPnow); ?>/<?php echo($HP); ?>" src="../barHP.php?a=<?php echo($HPnow); ?>&amp;b=<?php echo($HP); ?>">
            <img class="homebarimg" alt="<?php echo($XPnow); ?>/<?php echo($XP); ?>" src="../barXP.php?a=<?php echo($XPnow); ?>&amp;b=<?php echo($XP); ?>">
          </div>
          <div id="content">
            <?php
            $page = empty($_GET["page"]) || !isset($_GET["page"]) ? "home" : system::osetri_get($_GET["page"]);
            $action = isset($_GET["action"]) && !empty($_GET["action"]) ? system::osetri_get($_GET["action"]) : "";
            
            if($action != "" && $action == "logout")
            {
              delSession();
            }  
            
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
