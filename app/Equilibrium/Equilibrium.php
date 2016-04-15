<?php

namespace App\Equilibrium;

class Equilibrium
{

	/**
	 * Returns an array of equilibrium indexes from a sequential array.
	 * 
	 * @param  Array $arr
	 * @return Array $output
	 */
	public function getEquilibriumsSteps(Array $arr) {
		$output = [];

		for($i = 0; $i < count($arr); $i++) { 

			$left = $arr;
			array_splice($left, $i);
			$leftSum = array_sum($left); 
			$right = array_slice($arr, $i+1);
			$rightSum = array_sum($right);

			$output[$i]['string1'] = 
			($left ? implode(' &plus; ', $left) : '0 ')
			. ($leftSum === $rightSum ? ' &#61; ' : ' &#8800; ') .
			($right ? implode(' &plus; ', $right) : ' 0');
			$output[$i]['string2'] = '(' . $leftSum . 
			($leftSum === $rightSum ? ' &#61; ' : ' &#8800; ')
			. $rightSum . ')';
			$output[$i]['class'] = ($leftSum === $rightSum ? 'sucess' : 'error');
			$output[$i]['class'] = ($leftSum === $rightSum ? 'sucess' : 'error');
		}

		return $output; 
	}

}
