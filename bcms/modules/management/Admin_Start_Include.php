<?php	
echo"-------------XXX---------";
	//ob_start("callback");
	session_start();
	ini_set( 'display_errors', '1' );
	//----------------------------------------------------------------
	// check if log in session valid
	//----------------------------------------------------------------
	$include_dir="../../";
	$current_dir=pathinfo(__DIR__);
	$file_ext=substr($_SERVER["PHP_SELF"], -3, 3);
	$file_root=substr($_SERVER["PHP_SELF"], 0, 1);
	$slash_count=substr_count($_SERVER["PHP_SELF"],'/'); 
	if(($file_ext=="php")&&($file_root=="/")&&($slash_count==1)){
		// local admin content
		$include_dir="./";
	}elseif($_SERVER["PHP_SELF"]!="/index.php"){
		//$include_dir="../../";
		$include_dir="./";
	}else{
		$include_dir="./";
		if(isset($session_data["administratorsID"])){
			$loc="Location: /admin/main/logged-in/index.php";
			header($loc);
		}
	}
	echo"<br>\n\n 1200055666443211111222----------------------------|-|-------------------------------------------------\n\n";
	$tag_match_array=array();
	$dl=$include_dir."classes/setup-includes.php";
	echo "\n9996-".$dl;
	include($dl);
	exit();
	echo"<br>\n\n 1112000556664432100999----------------------------|-|-------------------------------------------------\n\n";
	//$dl=$include_dir."includes/functions.inc.php";
	echo "\n777999-".$dl;
	//include_once($dl);	
	echo "\n99893333-";echo"<br>\n\n 0123005566644321----------------------------|-|-------------------------------------------------\n\n";
	//-----------------------------------------------------------------------------------------------------------	
	// Set app variables from drop down menu posting
	//-----------------------------------------------------------------------------------------------------------
	if(isset($_POST['clientsID'])){
		if($_POST['clientsID']){
			$session_data['drop_down']['drop_down_clientsID']=$_POST['clientsID'];
		}
	}
	if((isset($_SESSION['drop_down']['drop_down_clientsID']))&&(!isset($_POST['clientsID']))){
		$session_data['drop_down']['drop_down_clientsID']=$_SESSION['drop_down']['drop_down_clientsID'];
	}
	if(isset($_POST['languagesID'])){
		if($_POST['languagesID']){
			$session_data['drop_down']['drop_down_languagesID']=$_POST['languagesID'];
		}
	}
	if((isset($_SESSION['drop_down_languagesID']))&&(!isset($_POST['languagesID']))){
		$session_data['drop_down']['drop_down_languagesID']=$_SESSION['drop_down']['drop_down_languagesID'];
	}
	if(isset($_POST['domainsID'])){
		if($_POST['domainsID']){
			$session_data['drop_down']['drop_down_domainsID']=$_POST['domainsID'];
		}
	}
	if((isset($_SESSION['drop_down']['drop_down_domainsID']))&&(!isset($_POST['languagesID']))){
		$session_data['drop_down']['drop_down_domainsID']=$_SESSION['drop_down']['drop_down_domainsID'];
	}
	if(isset($session_data['drop_down'])){
		$app_data['drop_down_vars']=$session_data['drop_down'];
	}else{
		$app_data['drop_down_vars']="";
	}
	

	echo "999-";
	//-----------------------------------------------------------------------------------------------------------	
	// Set domain
	//-----------------------------------------------------------------------------------------------------------
	try{
		$sql="SELECT domains.id,domains.Name,ClientsID FROM domains WHERE domains.Name='".$domain_data['domain_Name']."'";
		$rslt=$r->rawQuery($sql);
		$data=$r->Fetch_Array($rslt);
		$num_rows=$r->NumRows($rslt);
		if($num_rows>0){
			if(is_array($data)){
				$session_data['domainsID']=$data[0];
				$session_data['domain_name']=$data[1];
				$session_data['clientsID']=$data[2];
			}
		}		
	}catch(Exception $e){
	}
	//-----------------------------------------------------------------------------------------------------------	
	$app_data['domains_populate']['search_sql']="";
	$sql="";
	try{
		if(isset($session_data['clientsID'])){
			if(isset($session_data["SU"])){
				if($session_data["SU"]!="No"){
				
					$sql="SELECT domains.id,SiteTitle,Name as Host,mirrorID FROM domains WHERE clientsID=".$session_data['clientsID']." ORDER BY Name";
				
				}else{
					
					if(isset($session_data['administratorsID'])){
						$sql="SELECT domains.id,SiteTitle,Name as Host,mirrorID FROM domains,administrators_domains ";
						$sql.="WHERE domains.id=administrators_domains.domainsID AND administratorsID=".$session_data['administratorsID']." AND clientsID=".$session_data['clientsID'];
						$sql.=" ORDER BY Name";
					}else{
						$sql="SELECT domains.id,SiteTitle,Name as Host,mirrorID FROM domains WHERE id=666";
					}
					
				}
			}
			
			
		}else{
			if(!$session_data['clientsID']){
				$sql="SELECT domains.id,clientsID FROM domains WHERE id=".$session_data['domainsID']." LIMIT 0,1";
				$rslt=$r->rawQuery($sql);
				$data=$r->Fetch_Array();
				$session_data['clientsID']=$data[1];
				$app_data['clientsID']=$data[1];
			}
			
		}
		$app_data['domains_populate']['search_sql']=$sql;
	}catch(Exception $e){
	}	
		
	//-----------------------------------------------------------------------------------------------------------	
	// Set language
	//-----------------------------------------------------------------------------------------------------------
	try{
		$selected=0;
		$sql="SELECT id,Name FROM languages ORDER BY Name";
		$rslt=$r->rawQuery($sql);
		$LanguageCount=$r->NumRows($rslt);
		if($LanguageCount>0){
			while($data=$r->Fetch_Array($rslt)){
				$LanguageName=$data[1];
				if(isset($session_data['drop_down'])){
					if(!is_numeric($session_data['drop_down']['drop_down_languagesID'])){
						$session_data['drop_down']['drop_down_languagesID']=$data[0];
						//echo"--1111-\n\n";
					} 
					if($data[0]==$session_data['drop_down']['drop_down_languagesID']){
						$selected=1;
					}else{
						$selected=0;
					}
				}
				
				$app_data['languages'][]=array("id"=>$data[0],"name"=>$LanguageName,"selected"=>$selected);
				
			};
		}else{
		}
	
		/*
		if($sql!=""){
			$rslt=$r->rawQuery($sql);
			$num_rows=$r->NumRows($rslt);
			if($num_rows>0){
				while($data=$r->Fetch_Array($rslt)){
					print"xxdd456";
					print_r($data);
					$selected=($data[0]==$session_data['domainsID'] ? 1 : 0);
					$dval=$data[0]." -> ".$data[1];
					$app_data['domains'][]=array("id"=>$data[0],"title"=>$dval,"mirrorID"=>$data[3],"selected"=>$selected);
				};
			}
		
		}
		*/
		if(isset($session_data["SU"])){
			if($session_data["SU"]=="CWL"){ 
				$sql="SELECT id,Name FROM clients ORDER BY Name";
				
				$rslt=$r->RawQuery($sql);
				
				$client_count=$r->NumRows($rslt);
				print "\n\n -- 555123456--".$client_count."-".var_export($session_data,true)."-\n\n";
				if($client_count>0){
					while($data=$r->Fetch_Array($rslt)){
						$selected=($data[0]==$session_data['clientsID'] ? 1 : 0);
						$app_data['clients'][]=array("id"=>$data[0],"title"=>$data[1],"selected"=>$selected);
					};
				}
			}
		}
	}catch(Exception $e){
	}
	
	//--------------------------Set Global Administrators data---------------------------------------------------------------------------------	
	$app_data['administrators']=array();
	if(isset($session_data["administratorsID"])){
		$sql="SELECT * FROM administrators where id='".$session_data["administratorsID"]."' LIMIT 0,1";
		$data=$r->rawQuery($sql);
		$dataarray=$r->Fetch_Assoc($data);
		if(count($dataarray)>0){ //admin login ok
			$app_data['administrators']=$dataarray;
		}
	}
	//-----------------------------------------------------------------------------------------------------------	
	if(isset($session_data['languagesID'])){
		$app_data['languagesID']=$session_data['languagesID'];
	}elseif(isset($session_data['drop_down_languagesID'])){
		$app_data['languagesID']=$session_data['drop_down_languagesID'];
	}
	
	if(isset($session_data['domainsID'])){
		$app_data['domainsID']=$session_data['domainsID'];
	}elseif(isset($session_data['drop_down_domainsID'])){
		$app_data['domainsID']=$session_data['drop_down_domainsID'];
	}

	if(isset($session_data['clientsID'])){
		$app_data['clientsID']=$session_data['clientsID'];
	}elseif(isset($session_data['drop_down_clientsID'])){
		$app_data['clientsID']=$session_data['drop_down_clientsID'];
	}

	if(isset($session_data["SU"])){
		$app_data['SU']=$session_data["SU"];
	}
	echo"\n\n000108001234----------------------------||-------------------------------------------------\n\n";
	print_r($app_data);
?>