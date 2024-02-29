<?php
	//$sql="SELECT content_text FROM mod_text WHERE content_pagesID=".PAGESID;
	$sql="SELECT content_text FROM mod_text WHERE content_pagesID=".$content_data["db"]['id'];
	//print $sql;
	$log->general("-yyy Text Display->".$sql,3);
	$rows=array();
	$rslt=$r->RawQuery($sql);
	$rows=$r->Fetch_Assoc($rslt);
	if(count($rows)>0){
	    $text_data["db"]=$rows;
	}else{
	    $text_data["db"]=array();
	}
	
	//print_r($text_data);
	$log->general("-yx Text Display->".var_export($text_data["db"],true),3);
	
?>