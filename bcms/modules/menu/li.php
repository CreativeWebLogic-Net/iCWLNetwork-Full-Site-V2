<?php

	/*
	global $domain_user_data;
	if(count($domain_user_data)==0){
		if(isset($domain_data["original_db"])){
			$domain_name=$domain_data["original_db"]['Name'];
		}else{
			$domain_name=$domain_data["db"]['Name'];
		}
		
		if($_SESSION['membersID']>0){
			
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['db']['id']." OR domainsID=0) ORDER BY Sort_Order";
			
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
			$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['db']['id']." OR domainsID=0) ORDER BY Sort_Order";
		}
		//print $sql."\n";
		$rslt=$r->RawQuery($sql);
		while($data=$r->Fetch_Array($rslt)){
			?><li><a href="http://<?php print $domain_name.$data[0];?>"><?php print $data[1];?></a></li><?php
		}
	}else{
		?><li><a href="http://<? print $domain_name; ?>">Directory Home</a></li><?php	
	}
	*/

	include($app_data['MODULEBASEDIR']."menu/menu_base.php");
	//print_r($menu_data);
	$output_data="";
	foreach($menu_data["db"] as $key=>$val){
		if($menu_data['spacers']){
			if($val['first']==false){
				$output_data.=' | ';
			}
		}
		$output_data.='<li><a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'">'.$val["menutitle"].'</a></li>';
	}
	print $output_data;
?>