<?php
	include("../../Admin_Start_Include.php");
	
  if(isset($_POST['Delete'])){
    if($_POST['Delete']=="Delete"){
      if(is_array($_POST['DFiles'])){
        $m= new DeleteFromDatabase($log);
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
  }
	
  if(isset($_POST['Approve'])){
    if($_POST['Approve']=="Approve"){
      if(is_array($_POST['DFiles'])){
        $m= new BulkDBChange($log);
        $m->Set_Database($r);
        $m->AddIDArray($_POST['DFiles']);
        $m->WhatToChange("Approved","Yes",false);
        $m->AddTable("mod_news");
        $m->ChangeTarget("content_pagesID");
        $Errors=$m->DoChange();
        
        if($Errors==""){
          $Message="Promotion Enabled";
        }else{
          $Message=$Errors;
        };
      }else{
        $Message="No Promotions Selected To Enable";
      };
    };
  }
	
	
?>