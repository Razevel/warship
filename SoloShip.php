<?php

require_once 'Ship.php';

/**
* Однопалубный корабль
*/
class SoloShip
{

	public $node;

  	function SoloShip(&$map)
  	{
    	$this->node = new Ship();
	    
	    do {
	      	$this->node->x = rand(0, 9);
	      	$this->node->y = rand(0, 9);
	    }while ( !$this->node->validate($map) );

	    $map[$this->node->x][$this->node->y] = 1;
  	}

}