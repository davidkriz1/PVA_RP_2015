<div class="figthresultdiv">
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

  echo ($_COOKIE["result"]);
  setcookie("result", "", time() - 3600);
  ?>
</div>
<div class="homeplayersummarydiv">
  <div class="homeplayeravatar"></div>
  <div class="homeplayername">
  <?php
  echo($nick);
  ?>
  </div>
  <div class="homebardiv">
    <img class="homebarimg" alt="<?php echo($HPnow); ?>/<?php echo($HP); ?>" src="../barHP.php?a=<?php echo($HPnow); ?>&amp;b=<?php echo($HP); ?>">
    <img class="homebarimg" alt="<?php echo($XPnow); ?>/<?php echo($XP); ?>" src="../barXP.php?a=<?php echo($XPnow); ?>&amp;b=<?php echo($XP); ?>">
  </div>
  <div class="homespelldiv">
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
  </div>

  <div class="attackdefenddiv">
    <div class="attack">
    Útok: ### - ###
    </div>
    <div class="defend">
    Obrana: ######
    </div>
  </div>
  <div class="homestatsdiv">
  Síla:
  <?php
  echo($strength);
  ?>
  <br />
  Obratnost:
  <?php
  echo($dexterity);
  ?>
  <br />
  Výdrž:
  <?php  
  echo($stamina);
  ?>
  </div>  
</div>
<div class="resultcharacterwin">?</div>
<div class="NPCsummarydiv">
  <div class="homeplayeravatar"></div>
  <div class="homeplayername">
  <?php
  echo ($_COOKIE["NPCname"]);
  setcookie("NPCname", "", time() - 3600);
  ?>
  </div>
  <div class="homebardiv">
    <img class="homebarimg" alt="<?php echo($_COOKIE["NPChpnow"]); ?>/<?php echo($_COOKIE["NPChp"]); ?>" src="../barHP.php?a=<?php echo($_COOKIE["NPChpnow"]); ?>&amp;b=<?php echo($_COOKIE["NPChp"]); ?>">
    <?php
    setcookie("NPChp", "", time() - 3600);
    setcookie("NPChpnow", "", time() - 3600);
    ?>
  </div>
  <div class="homespelldiv">
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
    <div class="test2"></div>
  </div>

  <div class="attackdefenddiv">
    <div class="attack">
    Útok: ### - ###
    </div>
    <div class="defend">
    Obrana: ######
    </div>
  </div>
  <div class="homestatsdiv">
  Síla:
  <?php
  echo($_COOKIE["NPCstrength"]);
  setcookie("NPCstrength", "", time() - 3600);
  ?>
  <br />
  Obratnost:
  <?php
  echo($_COOKIE["NPCdexterity"]);
  setcookie("NPCdexterity", "", time() - 3600);
  ?>
  <br />
  Výdrž:
  <?php  
  echo($_COOKIE["NPCstamina"]);
  setcookie("NPCstamina", "", time() - 3600);
  ?>
  </div>  
</div>
