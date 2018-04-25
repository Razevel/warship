<?php

require_once 'Sheep.php';

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
		        new Sheep($this->map),
		        new Sheep($this->map),
		        new Sheep($this->map),
		        new Sheep($this->map),
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