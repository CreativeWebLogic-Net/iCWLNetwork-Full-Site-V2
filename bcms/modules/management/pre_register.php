<?php
    
	
	//include("./Admin_Start_Include.php");
	
	
	
	
	if(isset($_GET['Message']))$Message=$_GET['Message'];
	
	if(isset($_POST['Submit'])){
        if($_POST['contact_name']!=""){
          $client_name=$_POST['contact_name'];
        }else{
          $client_name=$_POST['name'];
        }
        $sql="INSERT INTO clients (Name) VALUES  ('".$client_name."')";
        
        //print $sql;
        $rslt=$r->RawQuery($sql);
        $Insert_Id=$r->Insert_Id();
    
        $hash=md5($_POST['username'].$_POST['password']);
        $sql="INSERT INTO administrators (name,email,username,password,administratorActive,SU,clientsID,hash) VALUES  ('".$_POST['contact_name']."','".$_POST['email']."'";
        $sql.=",'".$_POST['username']."','".$_POST['password']."','1','Yes','".$Insert_Id."','".$hash."')";
            
        //print $sql;
    
        //print_r($_POST);
        $rslt=$r->RawQuery($sql); 
        $AdministratorsID=$r->Insert_Id();
        //echo"10-----------------------------------------------------------".var_export($r,true)."------------------";
        if($_POST['subdomain']==""){
          $_POST['subdomain']=str_replace(" ","-",$client_name);
        }else{
          $_POST['subdomain']=str_replace(" ","-",$_POST['subdomain']);
        }
        
        $atd= new AddToDatabase($log);
        //echo"688-----------------------------------------------------------".var_export($r,true)."------------------";
        
       // $atd->Set_Log($log);
        $atd->Set_Database($r);
        //echo"689-----------------------------------------------------------".var_export($r,true)."------------------";
        
        $atd->Set_Vs($vs);
        $atd->AddPosts($_POST,$_FILES);
        
       // echo"690-----------------------------------------------------------".var_export($r,true)."------------------";
        
        $atd->AddTable("users");
        //echo"691-----------------------------------------------------------".var_export($r,true)."------------------";
        //$FieldArray=array("administratorsID"=>$AdministratorsID,"clientsID"=>$Insert_Id,"status"=>"New","administratorActive"=>0);
        $FieldArray=array("administratorsID"=>$AdministratorsID,"clientsID"=>$Insert_Id,"status"=>"New");
        $atd->AddExtraFields($FieldArray);
        //$atd->AddSkip(array("administratorActive"));
        $atd->DoStuff();
        $NewID=$atd->ReturnID();
        /* 2023-03-20
        2023-03-20 */
        $econtent="\n\n Welcome to iCWLNet website builder. \n";
        $econtent.="You must activate your account. Please follow the below link \n";
        $econtent.="https://sitemanage.info/index.php?hash=".$hash." \n";
        $econtent.="Contact Us: https://creativeweblogic.net \n";
        $to      = $_POST['email'];
        $subject = 'New User Register';
        $message = $econtent;
        $headers = array(
            'From' => 'admin@sitemanage.info',
            'Reply-To' => 'admin@sitemanage.info',
            'X-Mailer' => 'PHP/' . phpversion()
        );
    
        mail($to, $subject, $message, $headers);
  }

?>