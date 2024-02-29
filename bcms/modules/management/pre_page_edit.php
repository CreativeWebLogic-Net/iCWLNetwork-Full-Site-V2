<?php
	//include("../../Admin_Start_Include.php");
	
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
	$r->Set_Current_Server($app_data['remote_server']['domain_name']);
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
			if($_POST['HomePage']=="Yes"){
				$r->RawQuery("UPDATE content_pages SET HomePage='No' WHERE languagesID=$session_data[languagesID] AND domainsID=$session_data[domainsID]");
			}
			$_POST['URI']=dirify($_POST['URI']);// remove reserved characters
			if(substr($_POST['URI'],0,1)!="/") $_POST['URI']="/".$_POST['URI']; // if start of string not /
			if(substr($_POST['URI'],strlen($_POST['URI'])-1,1)!="/") $_POST['URI']=$_POST['URI']."/";// if end of string not /
			$m= new UpdateDatabase($log);
      $m->Set_Database($r);
			$m->AddPosts($_POST,$_FILES);
			$m->AddSkip(array("id"));
			$m->AddTable("content_pages");
			$m->AddFunctions(array("Changed"=>"NOW()"));
			$m->AddID($_POST['id']);
			$m->DoStuff();
			//change main text content
			$_POST['content_text']=$r->Escape($_POST['content_text']);
			$r->RawQuery("UPDATE mod_text SET content_text='$_POST[content_text]' WHERE content_pagesID=$_POST[id] AND sidebar_content='No'");
			//change sidebar text content
      /* removed 2023-03-19
			if($_POST['sidebar_module_viewsID']==11){
				$rslt=$r->RawQuery("SELECT COUNT(*) FROM mod_text WHERE content_pagesID=$_POST[id] AND sidebar_content='Yes'");
				if($rslt){
					$_POST['content_text_sidebar']=$r->Escape($_POST['content_text_sidebar']);
					$data=$r->Fetch_Array();
					if($data[0]>0){
						$r->RawQuery("UPDATE mod_text SET content_text='$_POST[content_text_sidebar]' WHERE content_pagesID=$_POST[id] AND sidebar_content='Yes'");//echo "xx";
					}else{
						$r->RawQuery("INSERT INTO mod_text (content_pagesID,content_text,sidebar_content) VALUES ($_POST[id],'$_POST[content_text_sidebar]','Yes')");//echo "yy";
					}
				}else{
					//echo "zz";	
				}
			}

      removed 2023-03-19 */
			$Message="Page Updated";
		};
	}else{
		
	}
	
	if(isset($_GET['id'])){
		if($_GET['id']) $id=$_GET['id'];
	}
	if(isset($_POST['id'])){
		if ($_POST['id']) $id=$_POST['id'];
	}
	
	
	
	//echo"=> 1add search var=>".var_export($_POST,true)."<=\n\n";
	$r->AddTable("content_pages");
	$r->AddSearchVar($id);
  //echo"=>2 add search var=>".var_export($_POST,true)."<=\n\n";
	$Insert=$r->GetRecord();
	$r->AddTable("mod_text");
	$r->AddSearchVar($id);
	$r->AddNewSearchVar("sidebar_content","No");
	$r->ChangeTarget("content_pagesID");
	$TInsert=$r->GetRecord();
  //print_r($TInsert);
	if(!isset($TSInsert['content_text'])){
    $TSInsert['content_text']="";
  }
  //$TSInsert['content_text']="";
  if(isset($Insert['sidebar_module_viewsID'])){
    if($Insert['sidebar_module_viewsID']==11){
      $r->AddTable("mod_text");
      $r->AddSearchVar($id);
      //$r->AddNewSearchVar("sidebar_content","Yes");
      $r->AddNewSearchVar("sidebar_content","No");
      $r->ChangeTarget("content_pagesID");
      $TSInsert=$r->GetRecord();
      //echo"=>content_text=>".var_export($TSInsert,true)."<=\n\n";
    }
  }
	
  //if(!isset($Insert['sidebar_module_viewsID'])) $Insert['sidebar_module_viewsID']=0;
?>