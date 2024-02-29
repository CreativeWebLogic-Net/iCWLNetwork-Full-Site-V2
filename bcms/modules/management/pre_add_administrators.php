<?php
	//include("../../Admin_Start_Include.php");
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
	
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
			$_POST['clientsID']=$session_data['clientsID'];
			$m= new AddToDatabase($log);
      $m->Set_Database($r);
			$m->AddPosts($_POST,$_FILES);
			$m->AddTable("administrators");
			$m->DoStuff();
			$NewID=$m->ReturnID();
			
      if(isset($_POST['domainsID'])){
        foreach($_POST['domainsID'] as $key=>$val){
            $r->RawQuery("INSERT INTO administrators_domains (administratorsID,domainsID) VALUES ($NewID,$val)");
          }
      }
			
			
			$Message="Administrator Added";
		};
	}
	
?>