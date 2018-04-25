<?php

require_once 'Sheep.php';

/**
* Однопалубный корабль
*/
class SoloSheep extends Sheep
{

  	function SoloSheep(&$map)
  	{
    
	    parent::__construct();
	    do {
	      	$this->position = [
	      		'x' => rand(0, 9),
	      		'y' => rand(0, 9),
	      	];
	    }while ( !$this->validate($map) );

	    $map[$this->position['x']][$this->position['y']] = 1;
  	}

}