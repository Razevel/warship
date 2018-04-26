<?php

include 'Game.php';
$game = new Game();

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
      <?php foreach($game->map as $line):?>
        <?php foreach($line as $cell):?>
          <div class="cell">
            <?php if($cell): ?>
              <img src="ship.png" class="ship-icon" >
            <?php endif ?>
          </div>
        <?php endforeach?>
      <?php endforeach?>
    </div>
    <h1 style="text-align: center;"><a href="/">Reload</a></h1>
  </div>
</body>
</html>