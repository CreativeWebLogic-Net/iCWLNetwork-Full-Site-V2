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
	
	/*
		if($_SESSION['membersID']>0){
			
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
			
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
			$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
		}
		//print $sql."\n";	
		$rslt=$r->RawQuery($sql);
		while($data=$r->Fetch_Array($rslt)){
			if(!$first){
				?> | <?
			}else{
				$first=false;
			}
			?><a href="/install.php?uri=<?php print urlencode($data[0]);?>"><?php print $data[1];?></a><?
		}
		//print $sql."\n";
		
	}else{
		?><a href="http://<? print $domain_data['Name']; ?>/index.php?uri=<?php print urlencode("/");?>">Directory Home</a><?	
	}
	*/

?>