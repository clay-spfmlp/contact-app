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
			//if($leftSum === $rightSum) $output[] = $i;

			// I left this in to show a visual representation of the process. 
			// uncomment below to view.
			$output[$i]['string1'] = 
			($left ? implode(' + ', $left) : '0 ')
			 . ' = ' . 
			($right ? implode(' + ', $right) : ' 0');
			$output[$i]['string2'] = '(' . $leftSum . ' = ' . $rightSum . ')';
			$output[$i]['class'] = ($leftSum === $rightSum ? 'sucess' : 'error');
			//$output[$i]['right'] = implode(', ', $right);
			//$output[$i]['rightSum'] = $rightSum;


			// dd($left);
			// dd('Left Sum :'.$leftSum);
			// dd($right);
			// dd('Right Sum :'.$rightSum);
			// dd('===============');

		}
		// and don't forget to return the output.
		return $output; 
	}

	/**
	 * Helper function to dump out values in a more readable way. 
	 * 
	 * @param  Any $value
	 */
	// public function dd($value, $die = false){
	// 	print '<pre>';
	// 	print_r($value);
	// 	print '</pre>';
	// 	if($die) exit;
	// }

	//dd(getEquilibriums(array(-7, 1, 5, 2, -4, 3, 0)), true);




	/**
	 * So when I goggled equilibrium indexes I came across this code, 
	 * not wanting to cheat I deiced I would come up with my own, but 
	 * after I was done I wanted to come back and look at the code I 
	 * found on-line. This code is a little better and I just wanted to 
	 * go over it and add my own comments to explain how this works.
	 *
	 * The best thing about this code is that it doesn't call any php 
	 * function inside the foreach loop which should be a big boost in 
	 * performance.
	 *
	 * Also this keeps a running total where as the code on top recreates 
	 * the totals each time it loops.
	 * 
	 * @param  Array $arr
	 * @return Array $equilibriums
	 */
	public function getEquilibriumsIndexs($arr) {

		// get the sum of the array right off the back.
	    $right = array_sum($arr);  
	    // set $left to 0 because at first there is nothing to the left.
	    $left = 0; 
	    // set an array to hold any value that return true.
	    $equilibriums = array(); 
	    // loop through the array. 
	    // (I prefer foreach loops, just wanted to show another way up top)
	    foreach($arr as $key => $value){ 
	        // remove its own value from the right sum, this will keep a 
	        // running total for the right sum.
	        $right -= $value; 
	        // checks if left and right are equal, if so add to the return array.
	        if($left == $right) $equilibriums[] = $key; 
	        // adds itself to the left sum for the next time it loops, this
	        // will keep a running total of the left sum.
	        $left += $value; 
	    }
	    return $equilibriums;
	}


}
