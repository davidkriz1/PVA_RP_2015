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
    $name = system::osetri($name);
    $result = mysqli_query($link, "SELECT * FROM game_users WHERE nick='".$name."'");
    return mysqli_fetch_assoc($result);
  }
  
  public static function getPlayerById($link, $id)
  {
    $id = system::osetri($id);
    $result = mysqli_query($link, "SELECT * FROM game_users WHERE id='".$id."'");
    return mysqli_fetch_assoc($result);
  }
  
  public static function updateLastvisit($link, $id)
  {
    return false;
  }

}
?>
