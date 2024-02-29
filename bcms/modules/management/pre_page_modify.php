<?php
	//include("../../Admin_Start_Include.php");
	if(isset($_POST['Delete'])){
		if($_POST['Delete']=="Delete"){
			if(is_array($_POST['DFiles'])){
        $r->Set_Current_Server($app_data['remote_server']['domain_name']);
				$m= new DeleteFromDatabase();
        $m->Set_Database($r);
				$m->AddIDArray($_POST['DFiles']);
				$m->AddTable("content_pages");
				$Errors=$m->DoDelete();
				if($Errors==""){
					$Message="Pages Deleted";
				}else{
					$Message=$Errors;
				};
			}else{
				$Message="No Pages Selected To Delete";
			};
		};
	}else{
		//$Message="No Pages Selected To Delete";
	}
	if(isset($_POST['Sort'])){
		if($_POST['Sort']){
			//print_r($_POST);
			if(is_array($_POST['SFiles'])){
        //$r->Set_Current_Server($app_data['remote_server']['domain_name']);
				$m= new BulkDBChange();
        $m->Set_Database($r);
				$m->AddIDMultiArray($_POST['SFiles']);
				$m->WhatToChange("Sort_Order");
				$m->AddTable("content_pages");
				$Errors=$m->DoChange();
				
				if($Errors==""){
					$Message="Sort Orders Changed";
				}else{
					$Message=$Errors;
				};
			}else{
				$Message="No Available Items";
			};
		};
	}
	
?>