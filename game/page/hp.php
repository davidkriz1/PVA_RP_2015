<?php
$sql = "SELECT * FROM game_users WHERE 1";
$result = mysqli_query($link, "SELECT * FROM game_users WHERE 1");
$e = "";

while($assoc = mysqli_fetch_assoc($result))
{
  $maxHP = ($assoc["level"] * 15) + 50 + ($assoc["stamina"] * 5);
  $sql2 = "UPDATE game_users set HP =".$maxHP." WHERE nick=".$assoc["nick"]."";
  $e .= sprintf("Player %s has now %d hp", $assoc["nick"], $maxHP); 
  $e .= "<br />";
  $resut = mysqli_query($link, $sql2);
}

echo $e;

?>
