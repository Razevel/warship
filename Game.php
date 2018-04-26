<?php

require_once 'SoloShip.php';
require_once 'DuoShip.php';
require_once 'TripleShip.php';

class Game 
{
	public $map;
	public $sheeps;
	
	public function Game(){
		$this->fillMap();
	}

	private function fillMap()
	{
	    $this->map = [
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	      	[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
	    ];

	    $sheeps = [
	      	[
		        new SoloShip($this->map),
		        new SoloShip($this->map),
		        new SoloShip($this->map),
		        new SoloShip($this->map),
	      	],
	      	[
	      		new DuoShip($this->map),
	      		new DuoShip($this->map),
	      		new DuoShip($this->map),
	      	],
	      	// [
	      	// 	new TripleShip($this->map),
	      	// 	new TripleShip($this->map),
	      	// ],
	    ];

	}

	public function showMap()
	{
		foreach ($this->map as $line) {
		    foreach ($line as $cell) {
		    	echo $cell . ' ';
		    }
	    	echo "<br/>";
	    }
	}


}