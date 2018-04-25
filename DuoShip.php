<?php

require_once 'Ship.php';



/**
* Двухпалубный корабль
*/
class DuoShip 
{
	public $nodes;

  	function DuoShip(&$map)
  	{
  		$this->nodes = [
  			new Ship(),
  			new Ship(),  			
  		];
  		
	    do {

	    	$x = rand(0, 9);
	    	$y = rand(0, 9);
	    	
	      	$this->nodes[0]->x = $x;
	      	$this->nodes[0]->y = $y;

			switch ($this->nodes[0]->getSide()) {
				case Ship::LEFT:
					$this->nodes[1]->x = $x;
	      			$this->nodes[1]->y = --$y;
					break;
				case Ship::UP:
					$this->nodes[1]->x = --$x;
	      			$this->nodes[1]->y = $y;
					break;
				case Ship::RIGHT:
					$this->nodes[1]->x = $x;
	      			$this->nodes[1]->y = ++$y;
					break;
				case Ship::DOWN:
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

