<?php
ob_start();
session_start();
session_save_path("\tmp");

require_once("config.php");

if(isset($_POST["register"]))
{
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

function trainingstrength()
{
  $data = mysqli_query($link, "SELECT * FROM game_users WHERE id=" . $_SESSION['id'] . "");
  $assoc = mysqli_fetch_assoc($data);
    
  $strength = $assoc["strength"];
    
  $gold = $assoc["gold"]; 
  $diamond = $assoc["diamond"];
    
  if($gold > 1)
  {          
 
    
    $strength = $strength + 1;
    mysqli_query($link, "UPDATE game_users SET strength = '" . $strength . "' WHERE id = " . $_SESSION['id'] . "");
    
    $gold = $gold - 1;
    mysqli_query($link, "UPDATE game_users SET gold = '" . $gold . "' WHERE id = " . $_SESSION['id'] . "");
  }
}

if (isset($_POST['trainingstdexterity']))
{

}

if (isset($_POST['trainingstamina']))
{

}

function playerdatafunction($link)
{
	$data = mysqli_query($link, "SELECT * FROM game_users WHERE id=" . $_SESSION['id'] . "");
	$playerdata = mysqli_fetch_assoc($data);
	return $playerdata;
}
?>
