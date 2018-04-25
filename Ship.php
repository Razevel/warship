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
				$a = [$x, $x+1];
				$b = [$y, $y+1];
			}
			// Правый нижний угол
			elseif( $y == 9 )
			{
				$a = [$x-1, $x];
				$b = [$y, $y+1];
			}
		}else 
		// На всякий случай, если я ошибся. Когда буду уверен уберу, если не убрал - забыл
			return false;
	  	
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

  	public function getSide()
  	{
  		
  		$x = $this->x;
  		$y = $this->y;
  		
  		$side = rand(self::LEFT, self::DOWN);

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
		return $side;
  	}

}