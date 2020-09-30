<?php 
	function dmd(...$users){
		echo "Debug Start Here --------------------------------";
		echo "<br>";
		echo "<br>";
		foreach ($users as $key => $user) {
			echo "Parameter Number: ".$key;
		    echo "<pre>";
		    	print_r($user->toArray());
		    echo "</pre>";
			echo "<br>";
		}

		echo "Debug End Here --------------------------------";
	    exit;
	}
?>