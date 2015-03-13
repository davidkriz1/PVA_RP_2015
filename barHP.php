<?php
#Errors
# Error #1 - Not enough args or negative numbers
# Error #2 - 2nd arg cannot be lesser than 1st one
# Error #3 - Integer args cannot be less than zero

if(!isset($_GET["debug"])) header("Content-Type: image/png");

// Nastavení a konstanty
$width = 200;
$height = 15;
$point = $width / 100;
$e = "";

// Načtení, ošetření a vypočet

$a = isset($_GET["a"]) ? $_GET["a"] : -1;
$b = isset($_GET["b"]) ? $_GET["b"] : -1;
$e .= $a < 0 || $b < 0 ? "#1" : "";


// Načtení, ošetření a vypočet
$e .= $a > $b ? "#2" : "";
$x = $a / ($b / 100);
$x = $x > 100 ? 100 : $x;
$x = $x < 0 && $a < 0 || $b < 0 ? -65535 : $x;

// Any args negative
$e .= $x == -65535 ? "#3" : "";


// Create image
$img = @imagecreate($width, $height) or die("Error");
$bgc = imagecolorallocate($img, 0, 0, 0);
$text_color = imagecolorallocate($img, 255, 255, 255);

// Červená: $x <= 25%
$r_fgc = imagecolorallocate($img, 255, 0, 0);
$r_bgc = imagecolorallocate($img, 153, 0, 0);
$r_tc = imagecolorallocate($img, 255, 255, 255);

// Zelená:  75% <= $x <= 100%
$g_fgc = imagecolorallocate($img, 0, 255, 0);
$g_bgc = imagecolorallocate($img, 0, 153, 0);
$g_tc = imagecolorallocate($img, 0, 0, 0);

// Žlutá:  25% < $x < 75%
$y_fgc = imagecolorallocate($img, 255, 255, 0); 
$y_bgc = imagecolorallocate($img, 255, 204, 0);
$y_tc = imagecolorallocate($img, 0, 0, 0);

if($e != "")
{
  $e = "Errors:".$e;
  imagestring($img, 2, $point * 40, 1, $e, $text_color);
  imagepng($img);
  imagedestroy($img);
  exit();    
}
else
{
  if($x < 25)
  {
    $prefix = "r";
  }
  else
  {
    if($x >= 25 && $x < 75)
    {
      $prefix = "y";
    }
    else
    {
      $prefix = "g";
      
    }
  }
}

imagefilledrectangle($img, 0, 0, $width, $height, ${$prefix."_bgc"});
imagefilledrectangle($img, 0, 0, $x * $point, $height, ${$prefix."_fgc"});
//imagestring($img, 2, 45 * $point, 1, sprintf("%.02d%%", $x), ${$prefix."_tc"});
imagestring($img, 2, 40 * $point, 1, sprintf("%d/%d HP", $a, $b), ${$prefix."_tc"});
imagepng($img);
imagedestroy($img);



?>
