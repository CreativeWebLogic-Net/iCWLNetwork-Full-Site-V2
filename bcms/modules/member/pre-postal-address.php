<?php
	//print "--666-77--".var_export($_SESSION,true)."===";
	//print_r($_POST);
	//print_r($_POST);
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
			
			$membersID=$_SESSION['membersID'];
			$m= new AddToDatabase($log);
			$m->ChangeInsertType("REPLACE");
			$m->Set_Log($log);
			$m->Set_Database($r);
			//$m->Set_Log_All();
			$m->AddPosts($_POST,$_FILES);
			$m->AddSkip(array("id"));
			$m->AddTable("user_details");
			$m->AddID($_SESSION['membersID']);
			$m->DoStuff();
			
		}
	}
	
?>