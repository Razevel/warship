<?php

require_once 'Sheep.php';
class DuoSheep extends Sheep
{

  	function DuoSheep(&$map)
  	{
  		parent::__construct();
	    do {

	    	$x = rand(0, 9);
	    	$y = rand(0, 9);
	    	
	      	$this->position = [
	      		[
	      			'x' => $x,
	      			'y' => $y,
	      		],
	      	];

	      	
	      	

	      	
	    }while ( !$this->validate($map) );

	    $map[$this->x][$this->y] = 1;
    }

}

