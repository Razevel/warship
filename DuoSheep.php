<?php

require_once 'Sheep.php';

class DuoSheep 
{
	public $nodes;

  	function DuoSheep(&$map)
  	{
  		$this->nodes = [
  			new Sheep(),
  			new Sheep(),  			
  		];
  		
	    do {

	    	$x = rand(0, 9);
	    	$y = rand(0, 9);
	    	
	      	$this->nodes[0]->x = $x;
	      	$this->nodes[0]->y = $y;

			switch ($this->nodes[0]->getSide()) {
				case Sheep::LEFT:
					$this->nodes[1]->x = $x;
	      			$this->nodes[1]->y = --$y;
					break;
				case Sheep::UP:
					$this->nodes[1]->x = --$x;
	      			$this->nodes[1]->y = $y;
					break;
				case Sheep::RIGHT:
					$this->nodes[1]->x = $x;
	      			$this->nodes[1]->y = ++$y;
					break;
				case Sheep::DOWN:
					$this->nodes[1]->x = ++$x;
	      			$this->nodes[1]->y = $y;
					break;
			}
			$this->nodes[0]->next = $this->nodes[1];
			$this->nodes[1]->prev = $this->nodes[0];


	    }while ( !$this->nodes[0]->validate($map) || !$this->nodes[1]->validate($map) );
	    
	   
	    $map[$this->nodes[0]->x][$this->nodes[0]->y] = 1;
	    $map[$this->nodes[1]->x][$this->nodes[1]->y] = 1;
    }

}

