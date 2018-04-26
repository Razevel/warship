<?php

require_once 'ShipDeck.php';

/**
* Корабль
*/
class Ship
{

	// Палубы
	public $nodes;


  	function Ship(&$map, $length = 1)
  	{	
  		// Создает {length} палуб.
  		$this->nodes = [];
 
		for($i=0; $i < $length; $i++) {
		   $this->nodes[] = new ShipDeck();
		}
  		

  		// Цикл размещения корабля, идет, пока корабль не встанет верно.
  		// Не предусматривает варианта, если валидного места под корабль нет в принципе.
	    do {

	    	// Положение первой палубы
	    	$x = rand(0, 9);
	    	$y = rand(0, 9);
	    	
	      	$this->nodes[0]->x = $x;
	      	$this->nodes[0]->y = $y;
	      	

	      	// Если не однопалубный корабль, строим еще.
	      	if($length>1){

		      	/* bool переменная, показывает, возможно ли хотябы в одну 
				* сторону достроить еще 1 палубу.
				*/
		      	$can = true;

		      	/* Получает рандомную из возможных сторон для продления корабля
		      	* на {length} палуб, если таких сторон нет, то переходит на след. 
		      	* итерацию, сли есть, то заполняет координаты палуб даного корабля 
		      	* 
				*/
				switch ($this->nodes[0]->getSide($map, $length)) {
					case ShipDeck::LEFT:
						for ($i=1; $i < $length; $i++) { 
							$this->nodes[$i]->x = $x;
							$this->nodes[$i]->y = --$y;
						}
			    		break;

					case ShipDeck::UP:
						for ($i=1; $i < $length; $i++) { 
							$this->nodes[$i]->x = --$x;
			    			$this->nodes[$i]->y = $y;
			    		}
						break;

					case ShipDeck::RIGHT:
						for ($i=1; $i < $length; $i++) { 
							$this->nodes[$i]->x = $x;
				    		$this->nodes[$i]->y = ++$y;
				    	}	
						break;

					case ShipDeck::DOWN:
						for ($i=1; $i < $length; $i++) { 
							$this->nodes[$i]->x = ++$x;
				    		$this->nodes[$i]->y = $y;
			    		}
						break;
					default:
						$can = false;
						break;
				}

				// Объединение палуб в корабль ( <-> список)
				$this->nodes[0]->next = $this->nodes[1];
				
				for ($i=1; $i < $length-1; $i++) { 
					$this->nodes[$i]->prev = $this->nodes[$i-1];
					$this->nodes[$i]->next = $this->nodes[$i+1];
				}

				$this->nodes[$length-1]->prev = $this->nodes[$length-2];
			}
			// Проверка каждой палубы на верное расположение на карте.
			$isValid = ($length>1)? $can : true;
			for ($i=0; $i < $length; $i++) { 
				$isValid = $isValid && $this->nodes[$i]->validate($map);
			}

	    }while ( !$isValid );
	    
	    // Выкалывание координат корабля на карте
	   	for ($i=0; $i < $length; $i++) { 
			$map[$this->nodes[$i]->x][$this->nodes[$i]->y] = 1;
	   	}
	    
    }

}