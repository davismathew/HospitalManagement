<?php
require_once('PosTagger.php');
require_once('db_conxn.php');
require_once('db_select.php');

/*
 * The file 'finddoc.php' has all the functions which process the input string and finds out 
 * returns as output the list of doctors
 * 
 */




/* This function is to check if there are substrings of string2 inside string1*/
function findMatch($string1,$string2){
	return substr_count($string1,$string2);
}

/*
 * Function searchDoc takes as input the symptom string and returns the doctors who deals with
 * diseases with such symptoms
 */
function searchDoc($symptom,$conxn) {
	//$val1 is the table name passed as the argument for search query
	   $val1="diseases";
       $result=dbselect($conxn,$val1);
	//iterate through the query results array
       while($row = mysqli_fetch_array($result))
       {
       	//checks if the syptom is there in symptoms row of  the table diseases
       		$dis=findmatch(strtolower(trim($row['symptom'])),strtolower(trim($symptom)));
       	//checks if the syptom is there in disease name(dname) row of  the table diseases
       		$sym=findmatch(strtolower(trim($row['dname'])),strtolower(trim($symptom)));
		//checks if there is any match and for true, adds it to an array $docids
			if(($dis!=0)||($sym!=0)){
				$docids=getdoclist($row['did'],$conxn);
				return $docids;
			}
       }
}

/*
 * This function is for finding the list of doctors
 */
function getdoclist($variable1,$conxn){
	//$val1 is the table name passed as the argument for search query
	$val1="doctors";
	$result=dbselect($conxn,$val1);
	//	echo "yes ".$variable1."  ..";
	$doc[]='';
	//iterate through the query results array
	while($row = mysqli_fetch_array($result))
	{
	       	$docid=findmatch(strtolower(trim($row['Diseases'])),strtolower(trim($variable1)));
	       	if ($docid!=0) $doc[]=$row['Dname'];
	}
	       	return $doc;
	/*	echo "//".$doc[0];
		echo "//".$doc[1];
		echo "//".$doc[2];*/
}


/* The main function which is called from Listdocs.php that takes search query entered by user as
 * input and returns/prints the doctor list
 */
function docsym($quer){
		echo $quer;
		$tagger = new PosTagger('lexicon.txt');
	//Passing the input string to PosTagger()
		$inputstring="I have stomach pain";
		$tags = $tagger->tag($quer);
		$stack=0;
	// assigning tokens to words[] array and tags to tagt[] array
        foreach($tags as $t) {
        	$words[]=$t['token'];
        	$tagt[]=$t['tag'];
        }
        $size=count($words);
	/*        for($i=0;$i<$size;$i++)
	        {
	        	echo $words[$i];
	        }
	*/
	// Establishing databse connection
        $conxn=dbconxn();
        $docnamelist[]=0;
        for($i=0;$i<$size-1;$i++)
        { 
          // checking if adjacent words are nouns
        	if((trim($tagt[$i])=='NN')&&(trim($tagt[$i+1])=='NN')){
	        		 $symptom=trim($words[$i])." ".trim($words[$i+1]);
	        		 echo $symptom;
	        		 $docnamelist=searchDoc($symptom,$conxn);
        	}
          // checking for all nouns if no adjacent nouns are found
        	else if((trim($tagt[$i])=='NN')){
        		$symptom=trim($words[$i]);
        		$docnamelist=searchDoc($symptom,$conxn);
        	}
        }

//        array_unique($docnamelist);
        $arrsize=count($docnamelist);
        for($k=0;$k<$arrsize;$k++){
        	echo "Doctor : ".$docnamelist[$k]."\n ";
        }
?>
<body>
				<?php // echo "Doctor : ".$docnamelist[0];?>
	        	<?php //echo ", Doctor : ".$docnamelist[1];?>
	        	<?php //echo ", Doctor : ".$docnamelist[2];?>
//	        	<?php //echo ", Doctor : ".$docnamelist[3];?>
<?php 
	        		 //foreach($tags )
//$tags = $tagger->tag("Joe drinks coffee");
//printTag($tags);The quick brown fox jumped over the lazy dog
        mysqli_close($conxn);
}     

?>
