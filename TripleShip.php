<?php



/**
* Трехпалубный корабль
*/
class TripleShip
{

	public $nodes;

  	function TripleShip(&$map)
  	{
  		$this->nodes = [
  			new Ship(),
  			new Ship(), 
  			new Ship(),  			
  		];
  		
	    do {

	    	$x = rand(0, 9);
	    	$y = rand(0, 9);
	    	
	      	$this->nodes[0]->x = $x;
	      	$this->nodes[0]->y = $y;
	      	
	      	$can = true;
	      		
			switch ($this->nodes[0]->getSide($map, 2)) {
				case Ship::LEFT:
					$this->nodes[1]->x = $x;
		    		$this->nodes[1]->y = --$y;
		    		$this->nodes[2]->x = $x;
		    		$this->nodes[2]->y = --$y;
		    		break;
				case Ship::UP:
					$this->nodes[1]->x = --$x;
		    		$this->nodes[1]->y = $y;
		    		
		    		$this->nodes[2]->x = --$x;
		    		$this->nodes[2]->y = $y;
		    		
		 			
					break;
				case Ship::RIGHT:
					$this->nodes[1]->x = $x;
		    		$this->nodes[1]->y = ++$y;
		    		
		    			$this->nodes[2]->x = $this->nodes[1]->x;
		    			$this->nodes[2]->y = ++$y;
		    			
					break;
				case Ship::DOWN:
					$this->nodes[1]->x = ++$x;
		    		$this->nodes[1]->y = $y;
		    		
		    			$this->nodes[2]->x = ++$x;
		    			$this->nodes[2]->y = $y;
		    			
		    		
					break;
				default:
					$can = false;
					break;
			}
			

			$this->nodes[0]->next = $this->nodes[1];
			$this->nodes[1]->prev = $this->nodes[0];
			$this->nodes[1]->next = $this->nodes[2];
			$this->nodes[2]->prev = $this->nodes[1];

	    }while ( !($can && $this->nodes[0]->validate($map) && $this->nodes[1]->validate($map) 
	    			&& $this->nodes[2]->validate($map))  );
	    
	   
	    $map[$this->nodes[0]->x][$this->nodes[0]->y] = 1;
	    $map[$this->nodes[1]->x][$this->nodes[1]->y] = 1;
	    $map[$this->nodes[2]->x][$this->nodes[2]->y] = 1;
    }

}