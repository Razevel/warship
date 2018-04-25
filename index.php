<?php


include 'Game.php';

$game = new Game();

$game->fillMap();

$map = $game->map;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WarSheeps</title>
  <link rel="stylesheet" type="text/css" href="site.css">
</head>
<body>
  <?=$game->showMap() ?>
  <div class="wrapper">
    <div class="field">
      <?php foreach($map as $line):?>
        <?php foreach($line as $cell):?>
          <div class="cell">
          <?php if($cell): ?>
          <img src="sheep.png" class="sheep-icon" >
          <?php endif ?>
          </div>
        <?php endforeach?>
      <?php endforeach?>
    </div>
  </div>
</body>
</html>