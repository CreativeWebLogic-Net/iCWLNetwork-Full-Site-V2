<?php
	
	if(count($domain_user_data)==0){
		if(isset($domain_data["original_db"])){
			$domain_name=$domain_data["original_db"]['Name'];
			$SEOFriendly=$domain_data["original_db"]['SEOFriendly'];
		}else{
			$domain_name=$domain_data["db"]['Name'];
			$SEOFriendly=$domain_data["db"]['SEOFriendly'];
		}
		//print_r($_SESSION);
		/*
        if(isset($_SESSION['membersID'])){
			$member_type="Member";
		}elseif(isset($_SESSION['administratorsID'])){
			$member_type="Admin";
		}else{
		    $member_type="Public";
		}
		*/
		if(!isset($_SESSION['administratorsID'])) $_SESSION['administratorsID']=0;
		if(!isset($_SESSION['membersID'])) $_SESSION['membersID']=0;
		
		 if($_SESSION['membersID']>0){
			$member_type="Member";
			$exposure="(Exposure='".$member_type."' OR Exposure='Both')";
		}elseif($_SESSION['administratorsID']>0){
			$member_type="Admin";
			$exposure="Exposure='".$member_type."'";
		}else{
		    $member_type="Public";
		    $exposure="(Exposure='".$member_type."' OR Exposure='Both')";
		}

		$menu_hide_sql=" Menu_Hide='No' AND ";
        $side_menu_sql=" AND content_pages.parentID=0";
        if($content_data['db']['domainsID']==0){
            $admin_menu_sql=" AND domainsID=0";
            
        }else{
            $admin_menu_sql=" AND domainsID=".$domain_data["db"]['id'];
        }
        
		
		$sql="SELECT DISTINCT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE ".$menu_hide_sql." ";
			$sql.=$exposure." AND languagesID=".$app_data['LANGUAGESID']." ".$admin_menu_sql." ".$side_menu_sql." ORDER BY Sort_Order";
        //print "\n ==>".$_SESSION['membersID']."\n";
        /*
		if($_SESSION['membersID']>0){
			
			$sql="SELECT DISTINCT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE Menu_Hide='No' AND  (Exposure='Member' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data["db"]['id']." OR domainsID=0)  GROUP BY URI ORDER BY Sort_Order";
			
		}else{
			$sql="SELECT DISTINCT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE  Menu_Hide='No' AND  (Exposure='Public' OR Exposure='Both')";
			$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data["db"]['id']." OR domainsID=0)  GROUP BY URI ORDER BY Sort_Order";
		}
		*/
	//	print $sql."\n";	
		$rslt=$r->RawQuery($sql);
		$first=true;
		if($r->NumRows($rslt)>0){
		    
		
    		while($data=$r->Fetch_Assoc($rslt)){
    			// show spacers in menu
    			if($menu_data['spacers']){
    				if($first){
    					$first=false;
    					$data['first']=true;
    				}else{
    					$data['first']=false;
    				}
    			}else{
    				// no show spacers in menu
    				$data['first']=true;
    			}
    			
    			if($SEOFriendly=="No"){
    				$data['link_address']='http://'.$domain_name.$app_data['ROOTDIR'].'index.php?guid=1&cpid='.$data["content_pagesid"];
    			}else{
    				$data['link_address']='http://'.$domain_name.$data["uri"];
    			}
    			$menu_data["db"][]=$data;
    		}
		}
	}else{
		$data=array();
		$data['first']=true;
		$data['link_address']='http://'.$domain_data["db"]['Name'];
		$data["menutitle"]="Directory Home";
		$menu_data["db"][]=$data;
	}

?>