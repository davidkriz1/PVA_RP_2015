<?php
ob_start();
session_start();

# Error reporting
//error_reporting(0);


require_once("config.php");

if(isset($_POST["register"]))
{
  $ok = 0;
  foreach($_POST as $k=>$v)
  {
    $$k = system::osetri($v);
  }
  
  if(empty($RegisterLogin) || !isset($RegisterLogin) || empty($RegisterPassword1) || empty($RegisterPassword2) || empty($RegisterEmail))
  {
    $e = "Nebyly vyplněny všechny údaje!";
  }
  else
  {
    if(db::isPlayerRegistered($link, $RegisterLogin))
    {
      $e = "Tento uživatel již existuje!";
    }
    else
    {
      if(!system::is_email($RegisterEmail))
      {
        $e = "Zadaný email je neplatný";
      }
      else
      {
        if(db::emailExists($link, $RegisterEmail))
        {
          $e = "Tento email již byl použit";
        }
        else
        {
          if($RegisterPassword1 != $RegisterPassword2)
          {
            $e = "Zadaná hesla nejsou stejná!";  
          }
          else
          {
            if($ps = mysqli_prepare($link, "INSERT INTO game_users (nick, password, email, lastvisit) values (?, ?, ?, ?)"))
            {
              $password = sha1($RegisterPassword1);
              $lastvisit = $_SERVER['REQUEST_TIME'];
            
              mysqli_stmt_bind_param($ps, "sssd", $RegisterLogin, $password, $RegisterEmail, $lastvisit);
              mysqli_stmt_execute($ps);
            
              $e = "Účet byl úspešně zaregistrován";
              $ok = 1;
            
              unset($RegisterEmail);
              unset($RegisterLogin);
            }
          }
        }
      }
    }  
  }

}

if (isset($_POST['login']))
{
  $ok = 0;
  foreach($_POST as $k=>$v)
  {
    $_POST[$k] = system::osetri($v);
  }
  
	if ((!isset($_POST["LoginName"]) || empty($_POST["LoginName"])) || (!isset($_POST["LoginPassword"]) || empty($_POST["LoginPassword"])))
	{
		$e = "Nebyla vyplněna všechna data!!";
	}
	else
	{ 
    if  (!db::isPlayerRegistered($link ,$_POST["LoginName"]))
    {
			$e = "Tento uživatel neexistuje!!";
		}
		else
		{
      $assoc = db::getPlayer($link, $_POST["LoginName"]);
      
      if(sha1($_POST["LoginPassword"]) != $assoc["password"] || !$assoc )
      { 
				$e = "Heslo není správné!!";
      }
      else
      {
				$nick = $_POST["LoginName"];
				$_SESSION["id"] = $assoc["id"];
				$_SESSION["lastvisit"] = $_SERVER["REQUEST_TIME"];
        echo("<script>window.location = 'game/index.php';</script>");
        			exit();
			}
		}		     
	}  
}

if (isset($_POST['logout']))
{
  delSession($link);
} 

  // Okamžité odhlášení
function delSession()
{
  if(!empty($_SESSION))
  {      
    $_SESSION = array();
    echo("<script>window.location = '../index.php';</script>");
  }
}

// Odhlášení při neaktivitě
if(empty($_SESSION["id"]))
{
  $_SESSION = array();
  session_destroy();
}
else
{
  if($_SESSION["lastvisit"] + 7200 <= time())
  {
    delSession();
  }
  else
  {
    if($_SESSION["lastvisit"] + 3* 300 <= time())
    {
      delSession();
    }
    else
    {
      $_SESSION["lastvisit"] = $_SERVER["REQUEST_TIME"];
      mysqli_query($link, "UPDATE game_users SET lastvisit = '" . time() . "' WHERE id = " . $_SESSION['id'] . "");
    }
  }
}

// funkce pro tréning ###############################################################################################
// funkce pro tréning ###############################################################################################
// funkce pro tréning ###############################################################################################

if (isset($_POST['trainingstrength']))
{
	trainingstrength($link);
}

function trainingstrength($link)
{
  $data = mysqli_query($link, "SELECT * FROM game_users WHERE id=" . $_SESSION['id'] . "");
  $assoc = mysqli_fetch_assoc($data);
    
  $strength = $assoc["strength"];
  $cost = $strength * 30;
    
  $gold = $assoc["gold"]; 
  $diamond = $assoc["diamond"];
    
  if($gold > $cost || $gold == $cost)
  {              
    $strength = $strength + 1;
    mysqli_query($link, "UPDATE game_users SET strength = '" . $strength . "' WHERE id = " . $_SESSION['id'] . "");
    
    $gold = $gold - $cost;
    mysqli_query($link, "UPDATE game_users SET gold = '" . $gold . "' WHERE id = " . $_SESSION['id'] . "");
  }
}

if (isset($_POST['trainingstdexterity']))
{
	trainingdexterity($link);
}

function trainingdexterity($link)
{
  $data = mysqli_query($link, "SELECT * FROM game_users WHERE id=" . $_SESSION['id'] . "");
  $assoc = mysqli_fetch_assoc($data);
    
  $dexterity = $assoc["dexterity"];
  $cost = $dexterity * 30;
    
  $gold = $assoc["gold"]; 
  $diamond = $assoc["diamond"];
    
  if($gold > $cost || $gold == $cost)
  {              
    $dexterity = $dexterity + 1;
    mysqli_query($link, "UPDATE game_users SET dexterity = '" . $dexterity . "' WHERE id = " . $_SESSION['id'] . "");
    
    $gold = $gold - $cost;
    mysqli_query($link, "UPDATE game_users SET gold = '" . $gold . "' WHERE id = " . $_SESSION['id'] . "");
  }
}

if (isset($_POST['trainingstamina']))
{
	trainingstamina($link);
}

function trainingstamina($link)
{
  $data = mysqli_query($link, "SELECT * FROM game_users WHERE id=" . $_SESSION['id'] . "");
  $assoc = mysqli_fetch_assoc($data);
    
  $stamina = $assoc["stamina"];
  $cost = $stamina * 30;

  $gold = $assoc["gold"]; 
  $diamond = $assoc["diamond"];
    
  if($gold > $cost || $gold == $cost)
  {              
    $stamina = $stamina + 1;
    mysqli_query($link, "UPDATE game_users SET stamina = '" . $stamina . "' WHERE id = " . $_SESSION['id'] . "");
    
    $gold = $gold - $cost;
    mysqli_query($link, "UPDATE game_users SET gold = '" . $gold . "' WHERE id = " . $_SESSION['id'] . "");
  }
}

if (isset($_POST['furiouswolf']))
{

  $playerdataassoc = playerdatafunction($link);
  $playerlevel = $playerdataassoc["level"];  
  $playerstrength = $playerdataassoc["strength"];
  $playerdexterity = $playerdataassoc["dexterity"];
  $playerstamina = $playerdataassoc["stamina"];  
  $playerhpnow = $playerdataassoc["HP"];
  
  //$playerstring = $playerweapon;
  $playerstring = 1-2;  
  $arr1 = explode('-', $playerstring);
  $playerweapon = rand((int)$arr1[0],(int)$arr1[1]);

  //$NPCstring = $NPCweapon;
  $NPCstring = 2-3;  
  $arr2 = explode('-', $NPCstring);
  $NPCweapon = rand((int)$arr2[0],(int)$arr2[1]);
  
  unset($playerstring);
  unset($NPCstring);  
  unset($arr1);
  unset($arr2);
  // nutno upravit
  $playerbonusposkozeni = 1;
  $playerbonusobrany = 1;
  $playerhodnotaobrany = 1;

  $NPCbonusposkozeni = 1;
  $NPCbonusobrany = 1;
  $NPChodnotaobrany = 1;
  //statistiky hráče

  //$playerhp = ($playerlevel * 15) + 50;

  $playerbonusposkozeni = 1 + ($playerbonusposkozeni / 100);
  $playerbonusobrany = 1 + ($playerbonusobrany / 100);

  $playerdamage = ($playerweapon + $playerstrength) * $playerbonusposkozeni;
  $playerdefend = ($playerhodnotaobrany + $playerdexterity) * $playerbonusobrany;
  
  //statistiky NPC
  $NPCstrength = 22;
  $NPCdexterity = 14;
  $NPCstamina = 10;
  
  //$NPCbonusposkozeni = 1 + ($NPCbonusposkozeni / 100);
  //$NPCbonusobrany = 1 + ($NPCbonusobrany / 100);
  
  $NPCdamage = ($NPCweapon + $NPCstrength) * $NPCbonusposkozeni;
  $NPCdefend = ($NPChodnotaobrany + $NPCdexterity) * $NPCbonusobrany;
  $NPChp = 50 + $NPCstamina;

  $finalplayerdamage = $playerdamage - $NPCdefend;
  $finalNPCdamage = $NPCdamage - $playerdefend;

  $win1 = $NPChp / $finalplayerdamage;
  $win2 = $playerhpnow / $finalNPCdamage;  

  if($win1 > $win2)
  {
    $NPChpnow = $NPChp - ($win2 * $finalplayerdamage);
    $playerhpnow = $playerhpnow - ($win2 * $finalNPCdamage);   
  }
  else
  {
    $NPChpnow = $NPChp - ($win1 * $finalplayerdamage);
    $playerhpnow = $playerhpnow - ($win1 * $finalNPCdamage);  
  }

  if($NPChpnow < 0)
  {
    $NPChpnow = 0;  
  }

  // výpočet pro hráče
  if($playerhpnow < 0)
  {
    $playerhpnow = 0;  
  }

  mysqli_query($link, "UPDATE game_users SET HP = '" . $playerhpnow . "' WHERE id = " . $_SESSION['id'] . "");

  // nastavení cookies - statistiky NPC
  $cookie_name = "NPCstrength";
  $cookie_value = $NPCstrength;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
  
  $cookie_name = "NPCdexterity";
  $cookie_value = $NPCdexterity;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
      
  $cookie_name = "NPCstamina";
  $cookie_value = $NPCstamina;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day

  $cookie_name = "NPChp";
  $cookie_value = $NPChp;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day

  $cookie_name = "NPChpnow";
  $cookie_value = $NPChpnow;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
  
  if($win1 < $win2)
  {    
    $cookie_name = "result";
    $cookie_value = "Vyhrál jsi!";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
  }
  else
  {
    if($win1 == $win2)
    {
      $cookie_name = "result";
      $cookie_value = "Remíza!";
      setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
    }
    else
    {
      $cookie_name = "result";
      $cookie_value = "Prohrál jsi!";
      setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
    }
  } 
  $cookie_name = "NPCname";
  $cookie_value = "Zuřivý vlk";
  setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
  
   echo("<script>window.location = 'index.php?page=result';</script>");  
}

function playerdatafunction($link)
{
	$data = mysqli_query($link, "SELECT * FROM game_users WHERE id=" . $_SESSION['id'] . "");
	$playerdata = mysqli_fetch_assoc($data);
	return $playerdata;
}
?>
