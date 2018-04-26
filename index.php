<?php
define('__DEBUG__', 'true');

ini_set("memory_limit","512M");
include 'Game.php';


$game = new Game();
$map = $game->map;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WarShips</title>
  <link rel="stylesheet" type="text/css" href="site.css">
</head>
<body>
  <div class="wrapper">
    <div class="field">
      <?php foreach($map as $line):?>
        <?php foreach($line as $cell):?>
          <div class="cell">
          <?php if($cell): ?>
          <img src="ship.png" class="ship-icon" >
          <?php endif ?>
          </div>
        <?php endforeach?>
      <?php endforeach?>
    </div>
  </div>
</body>
</html>