<?php
/*
	$first=true;
	if(count($domain_user_data)==0){
		
		if(isset($domain_data["original_db"])){
			$domain_name=$domain_data["original_db"]['Name'];
			$SEOFriendly=$domain_data["original_db"]['SEOFriendly'];
		}else{
			$domain_name=$domain_data["db"]['Name'];
			$SEOFriendly=$domain_data["db"]['SEOFriendly'];
		}
		

		if($_SESSION['membersID']>0){
			
			$sql="SELECT DISTINCT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) GROUP BY URI ORDER BY Sort_Order";
			
		}else{
			$sql="SELECT DISTINCT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
			$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data["db"]['id']." OR domainsID=0) GROUP BY URI ORDER BY Sort_Order";
		}
		///print $sql."\n";	
		$rslt=$r->RawQuery($sql);
		//while($data=$r->Fetch_Array($rslt)){
		while($data=$r->Fetch_Assoc($rslt)){
			if(!$first){
				?> | <?php
			}else{
				$first=false;
			}
			$menu_data["db"][]=$data;
			//print_r($data);
			if($SEOFriendly=="No"){
				//print $sql."\n";
				?><a id="link-item-id"  class="link-item-cl" href="http://<?php print $domain_name.$app_data['ROOTDIR']."index.php?guid=1&cpid=".$data["content_pagesid"];?>"><span class="link-item-cl"><?php print $data["menutitle"];?>;</span></a><?php
			}else{
				?><a id="link-item-id"  class="link-item-cl" href="http://<?php print $domain_name.$data["uri"];?>"><span class="link-item-cl"><?php print $data["menutitle"];?>;</span></a><?php
			}
		}
	}else{
		?><a href="http://<?php print $domain_data["db"]['Name']; ?>"><span class="link-item-cl">Directory Home</span></a><?php	
	}
*/
if(!isset($empty_tags)) $empty_tags=false;
if(!$empty_tags){
    echo'<div id="link-menu-container">&nbsp;&nbsp;';
    $link_css='id="link-item-id" class="link-item-cl"';
    $span_link_css_open='<span class="link-item-cl">';
    $span_link_css_close='</span>';
}else{
    $link_css='';
    $span_link_css_open='<span>';
    $span_link_css_close='</span>';
}

    include($app_data['MODULEBASEDIR']."menu/menu_base.php");
	//print_r($menu_data);
	$output_data="";
	if(isset($menu_data["db"])){
	    foreach($menu_data["db"] as $key=>$val){
    		if($menu_data['spacers']){
    			if($val['first']==false){
    				$output_data.=' | ';
    			}
    		}
    		$output_data.='<a '.$link_css.' href="'.$val['link_address'].'">'.$span_link_css_open.$val["menutitle"].$span_link_css_close.'</a>';
    	}
    	print $output_data;
	}
	
	if(!$empty_tags){
	    print '</div>';
	}
?>
