<?php

/*
 * dbselect() runs a query without condition and returns resultant set
 */
function dbselect($con,$vartab) {
	$queresult = mysqli_query($con,"SELECT * FROM ".$vartab);
	return $queresult;

}


/*
 * dbselectcondition() runs a query with condition and returns resultant set
*/
function dbselectcondition($con,$vartab,$varcond) {
	$result = mysqli_query($con,"SELECT * FROM ".$vartab." where catid='".$varcond."'");
	return $result;
	
}


?>