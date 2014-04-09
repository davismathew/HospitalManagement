<?php
$conxn=dbconxn();
$vartable="category";
$varcondition="";
$queryresult=dbselectcondition($conxn,$vartable,$itembeacon);
//iterate through the query results array
while($row = mysqli_fetch_array($queryresult))
{
	//		$catid=$row['catid'];
	$categories=array('id'=>$itembeacon,'name'=>$row['name'],'description'=>$row['description'],'imageurl'=>$row['image_url'],'items'=>additems($itembeacon));
	//		echo "nothing <br/>";
}
?>