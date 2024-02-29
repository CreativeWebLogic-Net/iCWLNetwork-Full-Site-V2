<?php
	include($app_data['MODULEBASEDIR']."menu/menu_base.php");
	//print_r($menu_data);
	$output_data="";
	foreach($menu_data["db"] as $key=>$val){
		if($menu_data['spacers']){
			if($val['first']==false){
				$output_data.=' | ';
			}
		}
		$output_data.='<a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'"><span>'.$val["menutitle"].'</span></a>';
	}
	print $output_data;
?>