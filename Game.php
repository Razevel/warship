<?php

require_once 'SoloSheep.php';
require_once 'DuoSheep.php';

class Game 
{
	public $map;
	public $sheeps;

	public function fillMap()
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
		        new SoloSheep($this->map),
		        new SoloSheep($this->map),
		        new SoloSheep($this->map),
		        new SoloSheep($this->map),
	      	],
	      	[
	      		new DuoSheep($this->map),
	      	],
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