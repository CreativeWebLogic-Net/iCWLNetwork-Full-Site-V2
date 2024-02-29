404 error, file not found.

<?php
    
    /*
    $site_map_page_data=array();
    $site_map_domain_data=array();
    if(count($DomainVariableArray)==0){
        if(isset($domain_data["db"]['id'])){
            $sql="SELECT * FROM content_pages WHERE (Exposure='Public' OR Exposure='Both') AND domainsID=".$domain_data["db"]['id'];
            //print $sql;
            $rslt=$r->RawQuery($sql);
            $num_rows=$r->NumRows($rslt);
            if($num_rows>0){
                while($content_pages["db"]=$r->Fetch_Assoc()){
                    $site_map_page_data["db"][]=$content_pages["db"];
                };
            }
        }else{
            //echo "domain not found";
        }
    }else{
        if(isset($domain_data["db"]['id'])){
            $sql="SELECT * FROM domains WHERE Name LIKE '%".$domain_data["db"]['Name']."'";
            //print $sql;
            $rslt=$r->RawQuery($sql);
            $num_rows=$r->NumRows($rslt);
            if($num_rows>0){
                while($domain_info=$r->Fetch_Assoc()){
                    $site_map_domain_data["db"][]=$domain_info;
                };
            }
        }else{
            //echo "domain not found";
        }
    }
    */
    $url_text="";
    /*
    if(isset($domain_data["original_db"])){
        $dd=$domain_data["original_db"];
    }else{
        $dd=$domain_data["db"];
    }
    */
    $dd=$domain_data["db"];
    if(isset($domain_data["original_db"])){
        //$dd=$domain_data["original_db"];
        $domain_name=$domain_data["original_db"]['Name'];
        $SEOFriendly=$domain_data["original_db"]['SEOFriendly'];
    }else{
        //$dd=$domain_data["db"];
        $domain_name=$domain_data["db"]['Name'];
        $SEOFriendly=$domain_data["db"]['SEOFriendly'];
    }
    
    //print "\n\nStart Pages->54321\n\n";
    //print_r($dd);
	$site_map_page_data=array();
    $site_map_domain_data=array();
    if(count($DomainVariableArray)==0){
        if(isset($dd['id'])){
            $sql="SELECT * FROM content_pages WHERE (Exposure='Public' OR Exposure='Both') AND domainsID=".$dd['id'];
            //print $sql;
            $rslt=$r->RawQuery($sql);
            $num_rows=$r->NumRows($rslt);
            if($num_rows>0){
                while($content_page=$r->Fetch_Assoc()){
                    //print_r($content_page);
                    $site_map_page_data["db"][]=$content_page;
                };
            }else{
                print "\n No Pages->12345->".$num_rows." \n";
            }
        }else{
            echo "domain not found";
        }
    }else{
        if(isset($dd['id'])){
            $sql="SELECT * FROM domains WHERE Name LIKE '%".$dd['Name']."'";
            //print $sql;
            $rslt=$r->RawQuery($sql);
            $num_rows=$r->NumRows($rslt);
            if($num_rows>0){
                while($domain_info=$r->Fetch_Assoc()){
                    $site_map_domain_data["db"][]=$domain_info;
                };
            }
        }else{
            //echo "domain not found";
        }
    }
    
    //print_r($site_map_page_data);
    
	if(count($site_map_page_data["db"])>0){
        $url_text="<br><br><h2>Pages on site: ".$domain_name."</h2><br>";
        foreach($site_map_page_data["db"] as $key=>$val){
            if($SEOFriendly=="No"){
                $url='http://'.$domain_name.$app_data['ROOTDIR'].'index.php?guid=1&cpid='.$val["id"];
                $url_text.="<a href='".$url."'>".$url." -> ".$val['Title']."</a><br>\n";
            }else{
                $url="http://".$domain_name.$val['URI'];
                $url_text.="<a href='".$url."'>".$url." -> ".$val['Title']."</a><br>\n";
            }
            //$url="http://".$dd['Name'].$val['URI'];
            //$url='http://'.$domain_name.$app_data['ROOTDIR'].'index.php?guid=1&cpid='.$data["content_pagesID"];
			//
        }
    }elseif(count($site_map_domain_data["db"])>0){
        $url_text="<br><br><h2>Domains referenced on site: ".$dd['Name']."</h2><br>";
        foreach($site_map_domain_data["db"] as $key=>$val){
            //$url="http://".$val['Name'];
            $url="http://".$domain_name;
            $url_text.="<a href='".$url."'>".$url." -> ".$val['SiteTitle']."</a><br>\n";
        }
    }
    
    echo $url_text;

?>
<script>
    //location.href = "/404.shtml";
</script>