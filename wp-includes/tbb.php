<?php
//
// parallel_do functions for hp-wordpress
//

if (defined('PARALLEL_DO_TBB')) {
	$parallel_do_funcs = array();

	function parallel_do_callback($indices)
	{
		global $parallel_do_funcs;

		// In the threadpool now!
		foreach ($indices as $idx) {
			 call_user_func($parallel_do_funcs[$idx]);
		}
	}

	function parallel_do()
	{
		global $parallel_do_funcs;
		$parallel_do_funcs = array(); // Import and clear global

		foreach (func_get_args() as $arg) {
			// If argument is valid then add it to list
			if (is_callable($arg)) $parallel_do_funcs[] = $arg;
		}

		// Call hiphop-tbb function 'parallel_for' with our callback
		parallel_for(0, sizeof($parallel_do_funcs), 'parallel_do_callback', 1);
	}
} else {
	function parallel_do()
	{
		// Serial Version
		foreach (func_get_args() as $arg) {
			if (is_callable($arg)) call_user_func($arg);
		}
	}
}
