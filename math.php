<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="http://home.spsostrov.cz/~krizda/php/SeaLogin.css" type="text/css">  
  <link type="text/css" href="css/default.css" rel="stylesheet">
  <link type="text/css" href="css/aligner.css" rel="stylesheet">
  <script src="libs/js/jquery-2.1.3.min.js" type="text/javascript"></script>
  <script src="libs/js/jquery-ui.min.js" type="text/javascript"></script>
  <title></title>
  </head>
  <body>
    <center>
<div style="
    background-color: rgba(0, 0, 0, 0.1);
    width: 600px;
    height: 700px;
">

<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" id="registerform" class="formregisterlogin" autocomplete="off" style="display: block;">
  Staty hráče
<div style="width: 450px;height: 250px;">
<div style="float: left;line-height: 1.7;">
<span class="registerusername">Level:</span>
<br>
<span class="registerpassword">Síla:</span>
<br>
<span class="registerpassword1">Obratnost:</span>
<br>
<span class="registeremail">Odoslnost:</span>
<br>
<span class="registeremail">Poškození zbraně:</span>
<br>
<span class="registeremail">Hodnota obrany brnění:</span>
<br>
<span class="registeremail">Kouzlo na zvýšení útoku v %:</span>
<br>
<span class="registeremail">Kouzlo na zvýšení obrany v %:</span>
</div>
<div style="float: right;width: 210px;">
  <input type="text" class="inputedit" name="Plevel" placeholder="Level"> 
  <input type="text" class="inputedit" name="Psila" placeholder="Síla">
  <input type="text" class="inputedit" name="Pobratnost" placeholder="Obratnost">
  <input type="text" class="inputedit" name="Podolnost" placeholder="Odolnost">
  <input type="text" class="inputedit" name="Pzbran" placeholder="Poškození zbraně">
  <input type="text" class="inputedit" name="Phodnotaobrany" placeholder="Hodnota obrany brnění">
  <input type="text" class="inputedit" name="Pbonusposkozeni" placeholder="Zvýšení útoku v %">
  <input type="text" class="inputedit" name="Pbonusobrany" placeholder="zvýšení obrany v %">
</div>
</div>

Staty protihráče

<div style="width: 450px;height: 250px;">
<div style="float: left;line-height: 1.7;">
<span class="registerusername">Level:</span>
<br>
<span class="registerpassword">Síla:</span>
<br>
<span class="registerpassword1">Obratnost:</span>
<br>
<span class="registeremail">Odoslnost:</span>
<br>
<span class="registeremail">Poškození zbraně:</span>
<br>
<span class="registeremail">Hodnota obrany brnění:</span>
<br>
<span class="registeremail">Kouzlo na zvýšení útoku v %:</span>
<br>
<span class="registeremail">Kouzlo na zvýšení obrany v %:</span>
</div>
<div style="float: right;width: 210px;">
  <input type="text" class="inputedit" name="Elevel" placeholder="Level"> 
  <input type="text" class="inputedit" name="Esila" placeholder="Síla">
  <input type="text" class="inputedit" name="Eobratnost" placeholder="Obratnost">
  <input type="text" class="inputedit" name="Eodolnost" placeholder="Odolnost">
  <input type="text" class="inputedit" name="Ezbran" placeholder="Poškození zbraně">
  <input type="text" class="inputedit" name="Ehodnotaobrany" placeholder="Hodnota obrany brnění">
  <input type="text" class="inputedit" name="Ebonusposkozeni" placeholder="Zvýšení útoku v %">
  <input type="text" class="inputedit" name="Ebonusobrany" placeholder="zvýšení obrany v %">
</div>
</div>         
<input type="submit" name="pocitat" id="registerbutton" class="submit" value="Počítat" style="margin-top: 3px;">
       </form>
<div style="color: red;">
<?php

if(isset($_POST["pocitat"]))
{
	foreach($_POST as $k=>$v)
	{
		$$k = htmlspecialchars($v);
	}





$Pzivoty = ($Plevel * 15) + 50;

$Ezivoty = ($Elevel * 15) + 50;

$Pbonusposkozeni = 1 + ($Pbonusposkozeni / 100);
$Pbonusobrany = 1 + ($Pbonusobrany / 100);

$Ebonusposkozeni = 1 + ($Ebonusposkozeni / 100);
$Ebonusobrany = 1 + ($Ebonusobrany / 100);

$PDMG = ($Pzbran + $Psila) * $Pbonusposkozeni;
$POBN = ($Phodnotaobrany + $Pobratnost) * $Pbonusobrany;
$PHP = $Pzivoty + $Podolnost;

#############################

$EDMG = ($Ezbran + $Esila) + $Ebonusposkozeni;
$EOBN = ($Ehodnotaobrany + $Eobratnost) * $Ebonusobrany;
$EHP = $Ezivoty + $Eodolnost;

$G1 = $PDMG - $EHP;
$G2 = $EDMG - $PHP;

}

	if (!isset($PDMG) || empty($PDMG) || !isset($POBN) || empty($POBN) || !isset($PHP) || empty($PHP) || !isset($EDMG) || empty($EDMG) || !isset($EOBN) || empty($EOBN) || !isset($EHP) || empty($EHP))
	{	
		echo("Vyplň pole!<br /><br />");
	}
	else
	{
		if($G1 > $G2)
		{
			echo("Vyhrál jsi!<br /><br />");
		}
		else
		{
			if($G1 = $G2)
			{
				echo("Remíza!<br /><br />");
			}
			else
			{
				echo("Prohrál jsi!<br /><br />");
			}
    }
      echo("Poškození hráče " . $PDMG . "<br />");
      echo("Obrana hráče " . $POBN . "<br />");
      echo("Životy hráče " . $PHP . "<br /><br />");


      echo("Poškození protihráče " . $EDMG . "<br />");
      echo("Obrana protihráče " . $EOBN . "<br />");
      echo("Životy protihráče " . $EHP . "<br />");
    }
?>
</div>
</div>
</center>
</body>
</html>
