<?php
	//include("../../Admin_Start_Include.php");
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
			if(($_POST['URI']=="")||($_POST['URI']=="/example-page-address/")){
				$_POST['URI']=$_POST['Title'];
			}
			$_POST['URI']=dirify($_POST['URI']);// remove reserved characters
			if(substr($_POST['URI'],0,1)!="/") $_POST['URI']="/".$_POST['URI']; // if start of string not /
			if(substr($_POST['URI'],strlen($_POST['URI'])-1,1)!="/") $_POST['URI']=$_POST['URI']."/";// if end of string not /
			if(($_POST['MenuTitle']=="")||($_POST['MenuTitle']=="Example Menu Title")){
				$_POST['MenuTitle']=$_POST['Title'];
			}
			if($_POST['Meta_Title']=="") $_POST['Meta_Title']=$_POST['Title'];
			if($_POST['HomePage']=="Yes"){
				$r->RawQuery("UPDATE content_pages SET HomePage='No' WHERE domainsID=".$app_data['domainsID']." AND languagesID=".$app_data['languagesID']);
			}
			// check if no homepage
			$rslt=$r->RawQuery("SELECT COUNT(*) FROM content_pages WHERE domainsID=".$app_data['domainsID']." AND languagesID=".$app_data['languagesID']);
			$data=$r->Fetch_Array($rslt);
			if($data[0]==0){// if none set current to home
				$_POST['HomePage']="Yes";
				$_POST['URI']="/";
			}
			$m= new AddToDatabase($log);
      $m->Set_Database($r);
			$m->AddPosts($_POST,$_FILES);
			$m->AddTable("content_pages");
			$m->AddExtraFields(array("languagesID"=>$app_data['languagesID']));
			$m->AddExtraFields(array("domainsID"=>$app_data['domainsID']));
			$m->AddExtraFields(array("module_viewsID"=>1));
			$m->AddFunctions(array("Changed"=>"NOW()"));
			$m->DoStuff();
			$NewID=$m->ReturnID();
			$m= new AddToDatabase($log);
      $m->Set_Database($r);
			$m->AddPosts($_POST,$_FILES);
			$m->AddTable("mod_text");
			$m->AddExtraFields(array("content_pagesID"=>$NewID,"sidebar_content"=>"No"));
			$m->DoStuff();
      /* removed 2023-03-19
			if($_POST['sidebar_module_viewsID']==11){
				$_POST['content_text_sidebar']=$r->Escape($_POST['content_text_sidebar']);
				$r->RawQuery("INSERT INTO mod_text (content_pagesID,content_text,sidebar_content) VALUES ($NewID,'$_POST[content_text_sidebar]','Yes')");
			}
			removed 2023-03-19 */
			$Message="Page Added";
		};
	}
  
	$r->AddTable("domains");
	$r->AddSearchVar($app_data['domainsID']);
	$DInsert=$r->GetRecord();
?>