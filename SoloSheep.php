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
	      	$this->x = rand(0, 9);
	      	$this->y = rand(0, 9);
	    }while ( !$this->validate($map, [$this->x, $this->y]) );

	    $map[$this->x][$this->y] = 1;
  	}

}