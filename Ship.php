<?php

/**
* Базовый класс для кораблей, описывает одну ячейку (?палубу?).
*/
class Ship
{
  	
	const LEFT  = 1;
  	const UP  	= 2;
 	const RIGHT = 3;
  	const DOWN  = 4;

  	public $prev;
  	public $next;

  	public $x;
  	public $y;

  	function __construct()
  	{
		$this->x = 0;
		$this->y = 0;
  	}

  	/*
  	*
  	* !!! ОСТОРОЖНО, МОЖЕТ БЫТЬ БОЛЬНО !!!
  	* 
  	* Валидация текущей позиции корабля. Вызывается после получения рандомных координат
  	* Если расположение не нарушает правил, возвращает true, иначе false.
  	* Проверяет где находится поле, чтобы провильно построить цикл,
  	* 1. 0 0 0 0 0     2. на краях     3. на углах 
  	*    0 0 1 0 0
  	*    0 0 0 0 0 
	* 
	* 	от -x   -y     не уходит в минус или плюс по той коре, которая на границе.       
	*   до +x   +y
	*
  	* Принимает 
  	*  	карту с расположением кораблей (00101 и тд), на которую не нанесено 
  	*   проверяемое поле (часть корабля).
  	*/
  	public function validate(&$map)
  	{
  		

		// Коры проверяемого поля 
		$x = $this->x;
		$y = $this->y;

		// Если поле не на краях карты
		if( $x>0 && $y>0 && $x<9 && $y<9 ) {

		  	$a = [$x-1, $x+1];
		  	$b = [$y-1, $y+1];

		}elseif( $y>0 && $y<9 ) {
			// Верхняя граница
			if( $x == 0 )
			{
				$a = [$x, $x+1];
				$b = [$y-1, $y+1];
		  	}
		  	// Нижняя граница
		  	elseif( $x == 9 )
		  	{
				$a = [$x-1, $x];
				$b = [$y-1, $y+1];
			} 
		}elseif ($x>0 && $x<9) {
			// Левая граница
		  	if( $y == 0 )
		  	{
				$a = [$x-1, $x+1];
				$b = [$y, $y+1];
		  	}
		  	// Правая граница
		  	elseif( $y == 9 )
		  	{
				$a = [$x-1, $x+1];
				$b = [$y-1, $y];  
		  	} 
		}elseif ($x == 0) {
			// Левый верхний угол
			if( $y == 0 )
			{
				$a = [$x, $x+1];
				$b = [$y, $y+1];
			}
			// Правый верхний угол
			elseif( $y == 9 )
			{
				$a = [$x, $x+1];
				$b = [$y-1, $y];
		  	}
		}elseif ( $x == 9 ) {
			// Левый нижний угол
		  	if( $y == 0 )
		  	{
				$a = [$x-1, $x];
				$b = [$y, $y+1];
			}
			// Правый нижний угол
			elseif( $y == 9 )
			{
				$a = [$x-1, $x];
				$b = [$y-1, $y];
			}
		}else 
			return false;
	  	
	  	if(defined('__DEBUG__') && __DEBUG__){
		  	echo 'x: '.$x.', dx: '.$a[0].'->'.$a[1].'<br/>';
		  	echo 'y: '.$y.', dy: '.$b[0].'->'.$b[1].'<hr/>';
		}

		for ( $i = $a[0]; $i <= $a[1]; $i++ ) { 
		  	for ( $j = $b[0]; $j <= $b[1]; $j++ ) 
		  	{ 
				if ( ( $this->prev && $i == $this->prev->x && $j == $this->prev->y ) || 
					 ( $this->next && $i == $this->next->x && $j == $this->next->y ) ) 
					continue;	
			
				if($map[$i][$j] == 1)
			  		return false; 
		  	}
		}
		return true;
  	}

  	private function _checkSide($map, $cors, $side, $length)
  	{
  		$x = $cors[0];
  		$y = $cors[1];

  		switch ($side) {
			case Ship::LEFT:

				$res = true;
				for ($i=0; $i < $length; $i++) { 
					if (($y-$i)>=0) {
						$res = $res && $map[$x][$y-$i] == 0;
					}else{
						$res = false;
					}
					
				}
				return $res;

				break;

			case Ship::UP:
				$res = true;
				for ($i=0; $i < $length; $i++) { 
					if (($x-$i)>=0) {
						$res = $res && $map[$x-$i][$y] == 0;
					}else{
						$res = false;
					}
				}
				return $res;

				break;
			case Ship::RIGHT:
				$res = true;
				for ($i=0; $i < $length; $i++) { 
					if (($y+$i)<=9) {
						$res = $res && $map[$x][$y+$i] == 0;
					}else{
						$res = false;
					}
				}
				return $res;

				break;
			case Ship::DOWN:
				$res = true;
				for ($i=0; $i < $length; $i++) { 
					if (($x+$i)<=9) {
						$res = $res && $map[$x+$i][$y] == 0;
					}else{
						$res = false;
					}
				}
				return $res;

				break;
			default:
				return false;
				break;
		}


  	}

  	public function getSide($map, $shipSize=1)
  	{
  		
  		$x = $this->x;
  		$y = $this->y;
  		
  		$side = rand(self::LEFT, self::DOWN);

  		for ($i=0; $i < 4; $i++) { 
  			
  		
		    // Если поле не на краях карты
			if( $x>0 && $y>0 && $x<9 && $y<9 ) {
				$side = rand(self::LEFT, self::DOWN);
			}elseif( $y>0 && $y<9 ) {
				// Верхняя граница
				if( $x == 0 )
				{
					while ($side == self::UP) {
						$side = rand(self::LEFT, self::DOWN);
					}
				}
				// Нижняя граница
				elseif( $x == 9 )
				{
					while ($side == self::DOWN) {
						$side = rand(self::LEFT, self::DOWN);
					}
				} 
			}elseif ($x>0 && $x<9) {
				// Левая граница
				if( $y == 0 )
				{
					while ($side == self::LEFT) {
						$side = rand(self::LEFT, self::DOWN);
					}
				}
				// Правая граница
				elseif( $y == 9 )
				{
					while ($side == self::RIGHT) {
						$side = rand(self::LEFT, self::DOWN);
					}
				} 
			}elseif ($x == 0) {
				// Левый верхний угол
				if( $y == 0 )
				{
					while (($side == self::UP) || ($side == self::LEFT)) {
						$side = rand(self::LEFT, self::DOWN);
					}
				}
				// Правый верхний угол
				elseif( $y == 9 )
				{
					while (($side == self::UP) || ($side == self::RIGHT)) {
						$side = rand(self::LEFT, self::DOWN);
					}
			  	}
			}elseif ( $x == 9 ) {
				// Левый нижний угол
			  	if( $y == 0 )
			  	{
					while (($side == self::DOWN) || ($side == self::LEFT)) {
						$side = rand(self::LEFT, self::DOWN);
					}
				}
				// Правый нижний угол
				elseif( $y == 9 )
				{
					while (($side == self::DOWN) || ($side == self::RIGHT)) {
						$side = rand(self::LEFT, self::DOWN);
					}
				}
			}
			if($this->_checkSide($map, [$x, $y], $side, $shipSize)){
				return $side;
			}

		}
		return false;

		
  	}

}