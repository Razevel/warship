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
	      	$this->node->x = rand(0, 9);
	      	$this->node->y = rand(0, 9);
	    }while ( !$this->node->validate($map) );

	    $map[$this->node->x][$this->node->y] = 1;
  	}

}