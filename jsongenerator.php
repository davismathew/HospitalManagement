<?php
require_once('db_conxn.php');
require_once('db_select.php');


/*
 * additems($catid) fetches all items with respect to a category from database and stores into
 * an array. The array is having arrays of objects of key:value pairs
 * eg: array(array('key1'=>'value','key2'=>'value'),array('key3'=>'value','key4'=>'value'))
 *               [[{key1:value},{key2:value}][{key3:value},{key4:value}]]
 */
function additems($catid){
	$conxn=dbconxn();
	$vartable="items";
	$queryresult=dbselectcondition($conxn,$vartable,$catid);
	//iterate through the query results array
	while($row = mysqli_fetch_array($queryresult))
	{
		$items[]=array('name'=>$row['description'],'majorminor'=>$row['item_major_minor'],'imageurl'=>$row['image_url'],'videourl'=>$row['video_url'],'isPush'=>$row['is_push']);
	}
	if(!empty($items)) {return $items;}
}


/*
 * addcategories() fetches all categories with respect to a shop from database and stores into
* an array. The array is having arrays of objects of key:value pairs
* eg: array(array('key1'=>'value','key2'=>'value'),array('key3'=>'value','key4'=>'value'))
*               [[{key1:value},{key2:value}][{key3:value},{key4:value}]]
*/
function addcategories(){
	$conxn=dbconxn();
	$vartable="categories";
	$varcondition="";
	$queryresult=dbselect($conxn,$vartable);
	//iterate through the query results array
	while($row = mysqli_fetch_array($queryresult))
	{
		$catid=$row['catid'];
		$categories[]=array('id'=>$row['catid'],'name'=>$row['name'],'description'=>$row['description'],'imageurl'=>$row['imageurl'],'items'=>additems($catid));
//		echo "nothing <br/>";
	}
	if(!empty($categories)) return $categories;

}

//calling categories() and fetiching the array of arrays
$category=addcategories();
//final format for converting into json data
$jsondata=array('beacons'=>(array('categories'=>($category))));

echo "<br/>";
echo "<br/>";
//converting into json format using json_encode() and printinig the result
echo json_encode($jsondata);
echo "<br/>";
echo "<br/>";


?>