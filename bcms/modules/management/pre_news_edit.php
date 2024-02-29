<?php
	include("../../Admin_Start_Include.php");
	
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
	
	if(isset($_POST['Submit'])){
    if($_POST['Submit']){
      $m= new UpdateDatabase($log);
      $m->Set_Database($r);
      $m->AddPosts($_POST,$_FILES);
      $m->AddSkip(array("id"));
      $m->AddTable("content_pages");
      $m->AddFunctions(array("Changed"=>"NOW()"));
      $m->AddID($_POST['id']);
      $m->DoStuff();
      $m= new UpdateDatabase($log);
      $m->Set_Database($r);
      $m->AddPosts($_POST,$_FILES);
      $m->AddSkip(array("id"));
      $m->AddTable("mod_news");
      $m->AddID($_POST['id']);
      $m->ChangeAutoInc("content_pagesID");
      $m->DoStuff();
      $Message="Page Updated";
    };
  };
	
	if(isset($_GET['id'])) $id=$_GET['id'];
	elseif (isset($_POST['id'])) $id=$_POST['id'];
	
	
	
	
	$r->AddTable("content_pages");
	$r->AddSearchVar($id);
	$Insert=$r->GetRecord();
	$r->AddTable("mod_news");
	$r->AddSearchVar($id);
	$r->ChangeTarget("content_pagesID");
	$TInsert=$r->GetRecord();
	

?>