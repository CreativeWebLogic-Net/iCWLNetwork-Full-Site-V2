<?php
	include("../../Admin_Start_Include.php");
	//-----------------------------------------------------------------------------------------------------------	
	// Get public domains to add subdomains
	//-----------------------------------------------------------------------------------------------------------
	try{
		//$r->Initialise_Remote_Server(true);
		$sql="SELECT id AS domainsID,domains.Name AS Host,ClientsID FROM domains WHERE Public='Yes'";
        $rslt=$r->rawQuery($sql);
        
        if($r->NumRows()>0){
            //$domain_name=$data[1];
            while($data=$r->Fetch_Assoc($rslt)){
              print_r($data);
                $app_data['public_domains'][]=$data;
            }
        }
	}catch(Exception $e){
		//print_r($e);
	}
	
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
  //--------Add new domain---------------------------------------------------------------------------------------------------	
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
      
      //------add domain to sitemanage.info-----------------------------------------------------------------------------------------------------	
      $r->Initialise_Remote_Server(true);
      $sql="SELECT id AS domainsID,Name AS Host,serversID FROM domains WHERE id='".$_POST['DomainsID']."'";
      $rslt=$r->rawQuery($sql);
      
      if($r->NumRows()>0){
        $data=$r->Fetch_Assoc();
        $app_data['selected_domain']=$data;
      }
      //------add domain to sitemanage.info-----------------------------------------------------------------------------------------------------	
      $_POST['Name']=$_POST['Name'].".".$app_data['selected_domain']['Host'];
      //$_POST['ClientsID']=$session_data['clientsID'];
      //$_POST['serversID']=$app_data['selected_domain']['serversID'];
      //------check domain unique-----------------------------------------------------------------------------------------------------	
     
      /*
      $sql="SELECT COUNT(*) AS domain_count FROM domains WHERE Name='".$_POST['Name']."'";
      print $sql;
      $rslt=$r->rawQuery($sql);
      $data=$r->Fetch_Array();
      
      if($data[0]>0){
        $Message="Website Taken Create A New Subdomain";

      }else{
       */ 
        //------add domain to sitemanage.info-----------------------------------------------------------------------------------------------------	
        $r->Initialise_Remote_Server(true);
        $m= new AddToDatabase($log);
        $m->Set_Database($r);
        $m->AddPosts($_POST,$_FILES);
        $m->AddExtraFields(array("ClientsID"=>$session_data['clientsID']));
			  $m->AddExtraFields(array("serversID"=>$app_data['selected_domain']['serversID']));
        $m->AddTable("domains");
        $m->DoStuff();
        $NewID=$m->ReturnID();

        
        if(isset($_POST['modulesID'])){
          if(is_array($_POST['modulesID'])){
            foreach($_POST['modulesID'] as $moduleID){
              $r->RawQuery("INSERT INTO domains_modules (domainsID,modulesID) VALUES ($NewID,$moduleID)");
            }
          }
        }
        
        //-------add domain to remote server----------------------------------------------------------------------------------------------------
        /*  2023-04-03
        $domain_name=$app_data['remote_server']['domain_name'];
	      $r->Set_Current_Server($domain_name);
        if($r->Original_DBFile!=$r->DBFile){
          //print "$$-".$domain_name."--\n";
          //print $app_data['selected_domain']['Host'];	
          //$r->Initialise_Remote_Server($app_data['selected_domain']['Host']);

          $m= new AddToDatabase($log);
          $m->Set_Database($r);
          $m->Set_Remote_Database($domain_name);
          $m->AddPosts($_POST,$_FILES);
          $m->AddExtraFields(array("ClientsID"=>$session_data['clientsID']));
          $m->AddExtraFields(array("serversID"=>$app_data['selected_domain']['serversID']));
          $m->AddTable("domains");
          $m->DoStuff();
          $NewID=$m->ReturnID();

          
          if(isset($_POST['modulesID'])){
            if(is_array($_POST['modulesID'])){
              foreach($_POST['modulesID'] as $moduleID){
                $r->RawQuery("INSERT INTO domains_modules (domainsID,modulesID) VALUES ($NewID,$moduleID)");
              }
            }
          }
        }
         2023-04-03 */
        
        //-------show page----------------------------------------------------------------------------------------------------	

        
        
        $Message="Website Added";
      //}
      
			
		};
	}
	
?>