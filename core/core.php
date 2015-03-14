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
	if ((!isset($_POST['LoginName']) || empty($_POST['LoginName'])) || (!isset($_POST['LoginPassword']) || empty($_POST['LoginPassword'])))
	{
		$error = "Nebyla vyplněna všechna data!!";
		}
	else
	{
		$data = mysqli_query($link, "SELECT * FROM game_users WHERE nick='".$_POST["LoginName"]."'");
		$assoc = mysqli_fetch_assoc($data);

		if  ($assoc["nick"]=="")
		{
			$e = "Tento uživatel neexistuje!!";
		}
		else
		{
			if  (sha1($_POST["LoginPassword"]) != $assoc["password"])
			{
				$e = "Heslo není správné!!";
			}
			else
			{
				$nick = $_POST["LoginName"];
				$_SESSION["id"] = $assoc["id"];
				$email = $assoc["email"];
				$isadmin = $assoc["isadmin"];
				$lastvisit = $_SERVER["REQUEST_TIME"];
				echo "<meta http-equiv='refresh' content='0';URL='/game/index.php?page=home'>";
				echo("Byl jsi přihlášen jako " . $nick . " ID:" . $_SESSION['id']);
			}
		}		     
	}  
}

if (isset($_POST['logout']))
{
	delSession($link);
} 

  // Okamžité odhlášení
function delSession($link)
{
	if(!empty($_SESSION))
	{      
		$_SESSION = array();
		echo "<meta http-equiv='refresh' content='0';URL='http://home.spsostrov.cz/~krizda/Game/index.php'>";
	}
}
?>
