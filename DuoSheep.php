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
	    	
	      	$this->nodes[0]->position = [
	      		'x' => $x,
	      		'y' => $y,
	      	];			

			switch ($this->nodes[0]->getSide()) {
				case Sheep::LEFT:
					echo "<-";
					$this->nodes[1]->position = [
						'x' => $x,
						'y' => --$y,
					];
					break;
				case Sheep::UP:
					echo "^";
					$this->nodes[1]->position = [
						'x' => --$x,
						'y' => $y,
					];
					break;
				case Sheep::RIGHT:
					echo "->";

					$this->nodes[1]->position = [
						'x' => $x,
						'y' => ++$y,
					];
					break;
				case Sheep::DOWN:
					echo "\/";

					$this->nodes[1]->position = [
						'x' => ++$x,
						'y' => $y,
					];
					break;
			}
			$this->nodes[0]->next = $this->nodes[1];
			$this->nodes[1]->prev = $this->nodes[0];


	    }while ( false);
	    var_dump($this->nodes[0]);die;
	    die();
	    $map[$this->position[0]['x']][$this->position[0]['y']] = 1;
    }

}

