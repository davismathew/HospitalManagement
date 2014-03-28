<?php
$test1=trim(strtolower("check"));
$test[]=$test1;
for($i=0;$i<10;$i++){
	$chec=trim(strtolower("checkwew"));
	$test[]="check";
}

$array = array(1, 2, 1, 3);
/*$array[]='Davis';
$array[]='Mathew';
$array[]='Davis';
$array[]='man';*/
echo $array[0]." ".$array[1]." ".$array[2]." ".$array[3];
$array = array_unique($array);
array_unique($test);
var_dump($array);

echo $array[0]." ".$array[1]." ".$array[2]." ".$array[3];
/*
 * 
 * I am editing thi file alone just for fun and thats it
 * 
 */

?>
