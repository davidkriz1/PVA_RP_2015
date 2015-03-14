<?php
Class db
{
  public static function isPlayerRegistered($link, $username)
  {
	 if($ps = mysqli_prepare($link, 'SELECT COUNT(*) FROM game_users WHERE nick = ?'))
	 {
		mysqli_stmt_bind_param($ps, 's', $username);
		mysqli_stmt_execute($ps);
		mysqli_stmt_bind_result($ps, $int);
    
		while (mysqli_stmt_fetch($ps)) 
		{
			$output = $int > 0 ? true : false;
			return $output;
		}
	 }
  }
  
  
  public static function emailExists($link, $email)
  {
	 if($ps = mysqli_prepare($link, 'SELECT COUNT(*) FROM game_users WHERE email = ?'))
	 {
		mysqli_stmt_bind_param($ps, 's', $email);
		mysqli_stmt_execute($ps);
		mysqli_stmt_bind_result($ps, $int);
    
		while (mysqli_stmt_fetch($ps)) 
		{
			$output = $int > 0 ? true : false;
			return $output;
		}    
  }
  
  }
  
  public static function getPlayer($link, $name)
  {
	 if($ps = mysqli_prepare($link, 'SELECT * FROM game_users WHERE nick = ?'))
	 {
		mysqli_stmt_bind_param($ps, 's', $name);
		mysqli_stmt_execute($ps);
    $result = mysqli_stmt_get_result($ps);
    return mysqli_fetch_assoc($result);  
  }
  return false;
  }
  
  public static function getPlayerById($link, $id)
  {
	 if($ps = mysqli_prepare($link, 'SELECT * FROM game_users WHERE id = ?'))
	 {
		mysqli_stmt_bind_param($ps, 'd', $id);
		mysqli_stmt_execute($ps);
    $result = mysqli_stmt_get_result($ps);
    return mysqli_fetch_assoc($result);  
  }
  return false;
  }

}
?>