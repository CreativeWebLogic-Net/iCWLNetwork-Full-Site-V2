<?php
	//include("../../Admin_Start_Include.php");

	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
			$r->AddTable("administrators");
			$r->AddSearchVar($session_data['administratorsID']);
			$Insert=$r->GetRecord();
			if(isset($_POST['cpassword'])){
          if(isset($Insert['password'])){
            if($_POST['cpassword']==$Insert['password']){
              $m= new UpdateDatabase($log);
              $m->Set_Database($r);
              $m->AddPosts($_POST,$_FILES);
              $m->AddTable("administrators");
              $m->AddID($session_data['administratorsID']);
              $str=$app_data['administrators']['username'].$app_data['administrators']['password'];
              $FieldArray=array("hash"=>md5($str));
              $m->AddExtraFields($FieldArray);
              $m->DoStuff();
              $Message="Password Updated";
            }else{
              $Message="Current Password Incorrect";
            }
          }
      }
			
		};
	}
	


?>