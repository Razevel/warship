<?php


require_once 'Ship.php';

/*
* Главный класс игры, заполняет карту.
*/
class Game 
{
	//Карта
	public $map;

	//Корабли
	public $ships;
	
	public function Game(){
		$this->fillMap();
	}

	private function fillMap()
	{ 	
		// Создает пустую карту 10х10 заполненую нулями.
		$this->map = [];
		for ($i=0; $i < 10; $i++) { 
			$tmp = [];
			for ($j=0; $j < 10; $j++) { 
				$tmp[] = 0;
			}
			$this->map[] = $tmp;
		}

		/* Создает корабли на карте */
		$this->ships = [];

	    for ($i=0; $i < 4; $i++) { 
	    	$tmp = [];
	    	for ($j=0; $j < (4-$i); $j++) { 
	    		$tmp[] = new Ship($this->map, $i+1);
	    	}
	    	$this->ships[] = $tmp;
	    }

	    /*
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

	    $ships = [
	      	[
	      		new Ship($this->map, 4),
	      	],
	      	[
	      		new Ship($this->map, 3),
	      		new Ship($this->map, 3),	      	 	
	      	],
	      	[
	      		new Ship($this->map, 2),
	      		new Ship($this->map, 2),
	      		new Ship($this->map, 2),
	      	],
	      	[
		        new Ship($this->map),
		        new Ship($this->map),
		        new Ship($this->map),
		        new Ship($this->map),
	      	],	      	
	    ];
	    */

	}

}