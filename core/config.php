<?php
# Načtení tříd
require_once("class/system.php");
require_once("class/db.php");

# Načtení dat
$json = file_get_contents("data.json", true);
$array = json_decode($json);

# Připojení k databázi
$link = mysqli_connect($array[0], $array[1], $array[2], $array[3]) or die("Nelze se připojit k databázi");

# Důležité konstanty


?>