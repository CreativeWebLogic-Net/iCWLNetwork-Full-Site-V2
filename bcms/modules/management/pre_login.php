<?php
	
	//
  //echo"0001----------------------------||-------------------------------------------------\n\n";

  if(isset($_GET['file'])){
    $file_name=$_GET['file'];
    header("Location: http://assets.localhost/".$file_name);
  }
	/*
	$load_file="./Admin_Start_Include.php";
  if(file_exists($load_file)){
    //echo"23322332111----------------------------||-------------------------------------------------\n\n";
	    include_once($load_file);
  }else{
    //echo"23322332----------------------------||-------------------------------------------------\n\n";
  }
  */
  //echo"0002----------------------------||-------------------------------------------------\n\n";
	//print_r($session_data);
	
	$login=false;
	
	if(isset($_GET['Message']))$Message=$_GET['Message'];
	if(isset($_GET['hash'])){
		$login=true;
		$sql="UPDATE administrators SET administratorActive=1 WHERE hash='".$_GET['hash']."'";
		$data=$r->rawQuery($sql);
		$sql="SELECT * FROM administrators where hash='".$_GET['hash']."' LIMIT 0,1";
	}

  //print_r($_POST);
	
	if(isset($_POST['Submit'])){
		if($_POST['Submit']!=""){
			$login=true;
			//$r=new ReturnRecord();
			//$sql="SELECT * FROM administrators where username='$_POST[UserName]' and password='$_POST[Password]' AND administratorActive=1 LIMIT 0,1";
			//print $sql;
			$sql="SELECT * FROM mod_user_accounts,mod_login_details where mod_user_accounts.mod_login_detailsID=mod_login_details.id AND username='$_POST[UserName]' and password='$_POST[Password]' LIMIT 0,1";
		}
	}

	if($login){
    //echo"\n\n0000----------------------------||-------------------------------------------------\n\n";
		$data=$r->rawQuery($sql);
    //print_r($data);
    //echo"\n\n0001----------------------------||-------------------------------------------------\n\n";
		//$dataarray=$r->Fetch_Array($data);
    $dataarray=$r->Fetch_Array($data);
		//print_r($dataarray);
    //echo"\n\n0002----------------------------||-------------------------------------------------\n\n";
	
		if(isset($dataarray[0])){
			if($dataarray[0]>0){ //admin login ok
				
				$session_data["administratorsID"]=$dataarray[0];
				$session_data["SU"]=$dataarray[6];
				$session_data["clientsID"]=$dataarray[7];
				$session_data["username"]=$dataarray[3];

				$session_data['original_clientsID']=$session_data["clientsID"];//$dataarray[2];
				$session_data['original_administratorsID']=$session_data["administratorsID"];//$dataarray[0];
				//echo"\n\n0002----------------------------||-------------------------------------------------\n\n";
		   // print_r($session_data);
				//$r=new ReturnRecord();
				if($session_data["SU"]=="CWL"){
					$sql="SELECT MIN( domains.id) FROM domains WHERE  clientsID=".$session_data['clientsID'];
				}else{
					$sql="SELECT MIN( domains.id) FROM domains,administrators_domains WHERE domains.id=administrators_domains.domainsID";
					$sql.=" AND administratorsID=$session_data[administratorsID] AND clientsID=$session_data[clientsID]";
				}
				
				//print "-\n\n-".$sql."-\n\n-";
				$rslt=$r->RawQuery($sql);
				if($rslt){
					if($r->NumRows($rslt)>0){
						$data=$r->Fetch_Array($rslt);
            //print($data[0]);
						if($data[0]>0){
							$session_data['original_domainsID']=$data[0];
              $_COOKIE['original_domainsID']=$data[0];
							//$session_data['domainsID']=$data[0];
							//print_r($session_data);
						}
					}
				}
        //echo"\n\n0003----------------------------||-------------------------------------------------\n\n";
        //print_r($session_data);
				//exit();
        $_SESSION=$session_data;
        
				$loc="Location: main/logged-in/index.php";
        //---------------------------2023-07-04-----------------------------
				header($loc);
        
        //---------------------------2023-07-04-----------------------------
				//print $loc;
			}else{	//admin login bad
				$Message="Incorrect Username or Password";
			};
		}else{
      //echo"\n\n0003-----|-".$sql."-|-------|-".var_export($data,true)."-|--------------------|-".var_export($dataarray,true)."-|------------------------------------------------0003-\n\n";
	
			$Message="Incorrect Username or Password";
			
		}

	}
  //echo"\n\n0004----------------------------||-------------------------------------------------\n\n";
	//print_r($session_data);
  //$_COOKIE=$session_data;
  //print_r($_COOKIE);
?>