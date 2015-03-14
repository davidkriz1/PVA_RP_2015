<?php
Class System
{
  public static function osetri($input)
  {
    $text = stripslashes(htmlspecialchars($input));
    
    $badchars = array("<", ">", " ");
    $text = str_replace($badchars, "", $text);
    
    return trim($text);
  }
  
  
  public static function osetri_get($input)
  {
    $text = stripslashes(htmlspecialchars($input));
    
    $badchars = array(".", "/");
    $text = str_replace($badchars, "", $text);
    
    return trim($text);
  }
  
  public static function is_email($email) 
  {   
	 if(preg_match("/^[\w-\.]+@([\w-]+\\.)+[a-zA-Z]{2,4}$/", $email)) 
	 {
		  return TRUE; 
	 }
	 return FALSE; 
  }
  
  public static function forceRedirect()
  {
    echo("<script>window.location = '..';</script>");
  }

}
?>
