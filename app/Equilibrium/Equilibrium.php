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
		$output = array();

		for($i = 0; $i < count($arr); $i++) { 

			$left = $arr;
			array_splice($left, $i);
			$leftSum = array_sum($left); 
			$right = array_slice($arr, $i+1);
			$rightSum = array_sum($right);
			$output[$i]['string1'] = 
			($left ? implode(' + ', $left) : '0 ')
			. ' &#61; ' .
			($right ? implode(' + ', $right) : ' 0');
			$output[$i]['string2'] = '(' . $leftSum . ' &#61; ' . $rightSum . ')';
			$output[$i]['class'] = ($leftSum === $rightSum ? 'sucess' : 'error');

		}
		return $output; 
	}

}
