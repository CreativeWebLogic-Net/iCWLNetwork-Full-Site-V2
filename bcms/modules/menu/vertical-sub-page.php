<?php

$show_side_menu=true;
include($app_data['MODULEBASEDIR']."menu/vertical_menu_base.php");
	//print_r($menu_data);
	//print $sql;
	$output_data="";
	if(isset($menu_data["vb"])){
	    foreach($menu_data["vb"] as $key=>$val){
    		if($menu_data['spacers']){
    			if($val['first']==false){
    				$output_data.='<br>';
    			}
    		}
    		$output_data.='<a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'"><span class="link-item-cl">'.$val["menutitle"].'</span></a>';
    	}
    	print $output_data;
	}
	
	//unset($show_side_menu);
?>