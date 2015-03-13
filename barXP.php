<?php
// Debug, převod na obrázek  
  if(!isset($_GET["debug"]))  header("content-type: image/png");

// Důležité proměnné
  $width = 200;
  $height = 15;
  $point = $width / 100;

// Obrázek, barvy
  $img = @imagecreate($width, $height) or die("Error");
  $flc = imagecolorallocate($img, 255, 204, 0);
  $slc = imagecolorallocate($img, 255, 255, 0); 
  $tlc = imagecolorallocate($img, 0, 0, 0);

// Načtení hodnot
  $a = isset($_GET["a"]) ? $_GET["a"] : -1;
  $b = isset($_GET["b"]) ? $_GET["b"] : -1;

// Opravy
  // Oprava záporných expů
  $a = $a < 0 ? 0 : $a;
  // Příprava pro výpis expů;
  $string = sprintf("%d/%d XP", $a, $b);
  // Oprava více jak maxima expů pro vykreslování 
  $a = $a > $b ? $b : $a;
  
// Vypočet procent
  $x = $a / ($b / 100);
  $p = $point * $x;   
  
// Vykreslení

  imagefilledrectangle($img, 0, 0, $width, $height, $flc);
  imagefilledrectangle($img, 0, 0, $p, $height, $slc);
  imagestring($img, 2, 40 * $point, 1, $string, $tlc);
  imagepng($img);
  imagedestroy($img);
?>
