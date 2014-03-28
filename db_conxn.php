<?php

/*
 * dbconxn() establishes connecion with mysql database
 */
function dbconxn() {
//	echo "tests";
	$con=mysqli_connect("localhost","davis","davis","hospital_management");
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
//	echo "check here";
	return $con;
}
?>