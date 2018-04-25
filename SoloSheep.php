<?php

require_once 'Sheep.php';

/**
* Однопалубный корабль
*/
class SoloSheep
{

	public $node;

  	function SoloSheep(&$map)
  	{
    	$this->node = new Sheep();
	    
	    do {
	      	$this->node->position = [
	      		'x' => rand(0, 9),
	      		'y' => rand(0, 9),
	      	];
	    }while ( !$this->node->validate($map) );

	    $map[$this->node->position['x']][$this->node->position['y']] = 1;
  	}

}