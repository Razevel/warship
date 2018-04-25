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
	      	
	      	do{
	      		
				switch ($this->nodes[0]->getSide()) {
					case Ship::LEFT:
						$this->nodes[1]->x = $x;
		      			$this->nodes[1]->y = --$y;
		      			if($this->nodes[1]->y>0){
		      				$this->nodes[2]->x = $x;
		      				$this->nodes[2]->y = --$y;
		      				$can = true;
		      			}
						break;
					case Ship::UP:
						$this->nodes[1]->x = --$x;
		      			$this->nodes[1]->y = $y;
		      			if($this->nodes[1]->x>0){
		      				$this->nodes[2]->x = --$x;
		      				$this->nodes[2]->y = $y;
		      				$can = true;
		 				}
						break;
					case Ship::RIGHT:
						$this->nodes[1]->x = $x;
		      			$this->nodes[1]->y = ++$y;
		      			if($this->nodes[1]->y<9){
		      				$this->nodes[2]->x = $this->nodes[1]->x;
		      				$this->nodes[2]->y = ++$y;
		      				$can = true;
		      			}
						break;
					case Ship::DOWN:
						$this->nodes[1]->x = ++$x;
		      			$this->nodes[1]->y = $y;
		      			if($this->nodes[1]->x<9){
		      				$this->nodes[2]->x = ++$x;
		      				$this->nodes[2]->y = $y;
		      				$can = true;
		      			}
						break;
				}
			}while ( !$can );

			$this->nodes[0]->next = $this->nodes[1];
			$this->nodes[1]->prev = $this->nodes[0];
			$this->nodes[1]->next = $this->nodes[2];
			$this->nodes[2]->prev = $this->nodes[1];

	    }while ( !$this->nodes[0]->validate($map) || !$this->nodes[1]->validate($map) 
	    			|| !$this->nodes[2]->validate($map)  );
	    
	   
	    $map[$this->nodes[0]->x][$this->nodes[0]->y] = 1;
	    $map[$this->nodes[1]->x][$this->nodes[1]->y] = 1;
	    $map[$this->nodes[2]->x][$this->nodes[2]->y] = 1;
    }

}