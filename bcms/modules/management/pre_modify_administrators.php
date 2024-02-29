<?php
	//include("../../Admin_Start_Include.php");
	
	if(isset($_POST['Delete'])){
		if($_POST['Delete']=="Delete"){
			if(is_array($_POST['DFiles'])){
				$m= new DeleteFromDatabase($log);
        print "654->->".var_export($m,true);
        $m->Set_Database($r);
				$m->AddIDArray($_POST['DFiles']);
				$m->AddTable("administrators");
				$Errors=$m->DoDelete();
				if($Errors==""){
					$Message="Administrators Deleted";
				}else{
					$Message=$Errors;
				};
			}else{
				$Message="No Administrators Selected To Delete";
			};
		};
	};
	
?>