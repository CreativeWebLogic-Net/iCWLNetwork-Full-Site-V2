<?php
	//include("../../Admin_Start_Include.php");
  //echo "-000----------------------------------------------------------------------------";
  
	//$r->Set_Current_Server($app_data['remote_server']['domain_name']);
  //$r->Initialise_Remote_Server(true);
  //print_r($_GET);
	$id=false;
  //$remote_domain_name=$app_data['remote_server']['domain_name'];
	if(isset($_GET['id'])) $id=$_GET['id'];
	elseif (isset($_POST['id'])) $id=$_POST['id'];
  if(isset($_POST['Name'])){
    $Domain_Name=$_POST['Name'];
  }else{
    $Domain_Name="sitemanage.info";
  }
 // print $id;
  //---get domain that is currently being edited--------------------------------------------------------------------------";
  
	if(is_numeric($id)){
    $Domain_Name=$app_data['remote_server']['domain_name'];
    //print $Domain_Name;
    
    //$r->Initialise_Remote_Server(true);
    //$r->Set_Current_Server($Domain_Name);
    $sql="SELECT COUNT(*) FROM domains WHERE id=$id AND clientsID=".$session_data['original_clientsID'];
    
		$rslt=$r->RawQuery($sql);
		$data=$r->Fetch_Array($rslt);
    
		if($data[0]==0){
      $error_message="Secuirty Error->".$sql." - ".$id." - ".var_export($data,true);
			exit($error_message);
		}else{
      $success_message="--311--Secuirty Error->".$sql." - ".$id." - ".var_export($data,true);
      //print $success_message;
    }
    
	}else{
		//print_r($_GET);
    $error_message="--303--Secuirty Error->".$id." - \n\n";
		//exit($error_message);
	}
  
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
      //---update sitemanage--------------------------------------------------------------------------";
      //$r->Initialise_Remote_Server(true);
			$m= new UpdateDatabase($log);
      $m->Set_Database($r);
			$m->AddPosts($_POST,$_FILES);
			$m->AddSkip(array("id"));
			$m->AddTable("domains");
			$m->AddID($id);
			$m->DoStuff();
			$Message="Website Updated";
			$r->RawQuery("DELETE FROM domains_modules WHERE domainsID=$id");
			if(isset($_POST['modulesID'])){
				if(is_array($_POST['modulesID'])){
					foreach($_POST['modulesID'] as $moduleID){
						$r->RawQuery("INSERT INTO domains_modules (domainsID,modulesID) VALUES ($id,$moduleID)");
					}
				}
			}
			$session_data['ModsPermArr']=GetModulesPermissions();

      //------get remote domain info-----------------------------------------------------------------------------------------------------	
      /*
      $r->Set_Current_Server($Domain_Name);
      $sql="SELECT id AS domainsID,Name AS Host,serversID FROM domains WHERE Name='".$Domain_Name."'";
      $rslt=$r->rawQuery($sql);
      
      if($r->NumRows()>0){
        $data=$r->Fetch_Assoc();
        $app_data['edit_domain']=$data;
      }
      */
      //---update remote server--------------------------------------------------------------------------";
      
      /*
      $m= new UpdateDatabase($log);
      $m->Set_Database($r);
      $m->Set_Remote_Database($Domain_Name);
			$m->AddPosts($_POST,$_FILES);
			$m->AddSkip(array("id"));
			$m->AddTable("domains");
			$m->AddID($app_data['edit_domain']["domainsID"]);
			$m->DoStuff();
      if(isset($_POST['modulesID'])){
				if(is_array($_POST['modulesID'])){
					foreach($_POST['modulesID'] as $moduleID){
						$r->RawQuery("INSERT INTO domains_modules (domainsID,modulesID) VALUES ($id,$moduleID)");
					}
				}
			}
			$Message="Website Updated";
      */
		};
	};
  
	//---retrieve remote server domain variables to edit--------------------------------------------------------------------------";
  //$Domain_Name=$app_data['remote_server']['domain_name'];
  //$r->Initialise_Remote_Server(true);
  $r->AddTable("domains");
	$r->AddSearchVar($id);
	$Insert=$r->GetRecord();
  //print_r($Insert);
	$ModsArr=array();
	$rslt=$r->RawQuery("SELECT modulesID FROM domains_modules WHERE domainsID=$id");
	while($myrow=$r->Fetch_Array($rslt)){
		$ModsArr[]=$myrow[0];
	}
  
  //---show page--------------------------------------------------------------------------";
  
?>