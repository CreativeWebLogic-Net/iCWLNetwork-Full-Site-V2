<?php
	//include("../../Admin_Start_Include.php");
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
  //print_r($session_data);
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
      
			//$_POST['ClientsID']=$session_data['original_clientsID'];
			$m= new AddToDatabase($log);
      $m->Set_Database($r);
			$m->AddPosts($_POST,$_FILES);
      $m->AddExtraFields(array('ClientsID'=>$session_data['original_clientsID'],"serversID"=>13));
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
			
			
			
			$Message="Website Added";
		};
	}
	
?>