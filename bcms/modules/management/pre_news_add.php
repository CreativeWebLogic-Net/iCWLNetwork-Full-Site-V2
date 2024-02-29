<?php
	include("../../Admin_Start_Include.php");
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
	
  if(isset($_POST['Submit'])){
    if($_POST['Submit']){
      if(isset($_POST['URI'])){
        if(($_POST['URI']=="")||($_POST['URI']=="/news-item/example-page-address/")){
          if(isset($_POST['Title'])){
            $_POST['URI']="/news-item/".urlencode(str_replace(" ","-",$_POST['Title']))."/";
          }
        }
      }
      if(isset($_POST['Meta_Title'])){
        if($_POST['Meta_Title']=="") $_POST['Meta_Title']=$_POST['Title'];
      };
      $m= new AddToDatabase($log);
      $m->Set_Database($r);
      $m->AddPosts($_POST,$_FILES);
      $m->AddTable("content_pages");
      $m->AddExtraFields(array("languagesID"=>$session_data['languagesID']));
      $m->AddExtraFields(array("domainsID"=>$session_data['domainsID']));
      $m->AddExtraFields(array("module_viewsID"=>332));
      $m->AddExtraFields(array("Menu_Hide"=>"Yes"));
      $m->AddFunctions(array("Changed"=>"NOW()"));
      $m->DoStuff();
      $NewID=$m->ReturnID();
      $m= new AddToDatabase($log);
      $m->Set_Database($r);
      $m->AddPosts($_POST,$_FILES);
      $m->AddTable("mod_news");
      $m->AddExtraFields(array("content_pagesID"=>$NewID));
      $m->AddExtraFields(array("Approved"=>"Yes"));
      $m->DoStuff();
      
      
      $Message="Page Added";
    };
  };
	
  $r->AddTable("domains");
	$r->AddSearchVar($session_data['domainsID']);
	$DInsert=$r->GetRecord();
  if(!isset($DInsert['templatesID'])) $DInsert['templatesID']=0;
?>