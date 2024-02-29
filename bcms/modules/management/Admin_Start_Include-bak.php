<?php	
	//ob_start("callback");
	//echo"0003----------------------------||-------------------------------------------------\n\n";
		//
	//$session_data=$_COOKIE;
	//echo"\n\n00010----------------------------||-------------------------------------------------\n\n";
	//print_r($_COOKIE);
	session_start();

	
	ini_set( 'display_errors', '1' );
	$session_data=$_SESSION;
	//echo"000----------------------------||-------------------------------------------------\n\n";
					
	
	//----------------------------------------------------------------
	// check if log in session valid
	//----------------------------------------------------------------
	$include_dir="../../";
	$current_dir=pathinfo(__DIR__);
	$file_ext=substr($_SERVER["PHP_SELF"], -3, 3);
	$file_root=substr($_SERVER["PHP_SELF"], 0, 1);
	$slash_count=substr_count($_SERVER["PHP_SELF"],'/'); 
	//if($_SERVER["PHP_SELF"]!="/index.php"){
	if(($file_ext=="php")&&($file_root=="/")&&($slash_count==1)){
		// local admin content
		$include_dir="./";
		//print $file_ext."-->".$file_root."->".$slash_count;
		
	}elseif($_SERVER["PHP_SELF"]!="/index.php"){
		$include_dir="../../";
		/*
		if(!isset($session_data['drop_down_administratorsID'])){
			$loc="Location: /logout.php";
			print_r($session_data);
			exit("Bad-Login");
			header($loc);
			//
		}
		*/
	}else{
		$include_dir="./";
		if(isset($session_data["administratorsID"])){
			$loc="Location: main/logged-in/index.php";
			header($loc);
		}
	}
	
	$tag_match_array=array();
	//echo"<br>0005501----------------------------|-|-------------------------------------------------\n\n";
	include($include_dir."setup-includes.php");
	include_once($include_dir."includes/functions.inc.php");
	ob_start("callback");
	
	//echo"<br>\n\n 00055----------------------------|-|-------------------------------------------------\n\n";
	
	//-----------------------------------------------------------------------------------------------------------	
	// Set app variables from drop down menu posting
	//-----------------------------------------------------------------------------------------------------------
	
	if(isset($_POST['LanguagesID'])){
		if($_POST['LanguagesID']){
			$session_data['drop_down_languagesID']=$_POST['LanguagesID'];
			$LanguagesID=$_POST['LanguagesID'];
		}elseif(!$session_data['drop_down_languagesID']){
			$session_data['drop_down_languagesID']=1;
			$LanguagesID=1;
		}else{

		}
	}else{
		$session_data['drop_down_languagesID']=1;
		
		$LanguagesID=1;
	}
	$session_data['languagesID']=$session_data['drop_down_languagesID'];
	
	//print_r($session_data);
	//$app_data['LANGUAGESID']=$LanguagesID;
	$app_data['LANGUAGESID']=$session_data['languagesID'];
	
	if(isset($_POST['clientsID'])){
		if($_POST['clientsID']){
			
			$session_data['drop_down_clientsID']=$_POST['clientsID'];
			//$session_data['clientsID']=$session_data['drop_down_clientsID'];
			//
			/*
			$session_data['drop_down_languagesID']=false;
			*/
			$session_data['drop_down_domainsID']=false;
			echo"--44845-\n\n".var_export($session_data,true)."--4484599-\n\n";
		}
		/*
		else{
			if(!isset($session_data['drop_down_clientsID'])){
				$session_data['drop_down_clientsID']=false;
			}
			if(isset($_POST['languagesID'])){
				if($_POST['languagesID']){
					$session_data['drop_down_languagesID']=$_POST['languagesID'];
				}
			}
			if(isset($_POST['domainsID'])){
				if($_POST['domainsID']){
					$session_data['drop_down_domainsID']=$_POST['domainsID'];
				}
			}
		}
		*/
	}else{
		if(!isset($session_data['drop_down_clientsID'])){
			$session_data['drop_down_clientsID']=false;
		}
		if(isset($_POST['languagesID'])){
			if($_POST['languagesID']){
				$session_data['drop_down_languagesID']=$_POST['languagesID'];
			}
		}else{
			$session_data['drop_down_languagesID']=false;
		}
		if(isset($_POST['domainsID'])){
			if($_POST['domainsID']){
				$session_data['drop_down_domainsID']=$_POST['domainsID'];
			}
		}else{
			$session_data['drop_down_domainsID']=false;
		}
	}
	//$session_data['clientsID']=$session_data['drop_down_domainsID'];
	print_r($session_data);
	echo"--44844-\n\n";

	$session_data['languagesID']=$session_data['drop_down_languagesID'];

	if(isset($session_data['languagesID'])) $app_data['drop_down_vars']['languagesID']=$session_data['languagesID'];
	if(isset($session_data['domainsID'])) $app_data['drop_down_vars']['domainsID']=$session_data['domainsID'];
	if(isset($session_data['drop_down_clientsID'])) $app_data['drop_down_vars']['clientsID']=$session_data['drop_down_clientsID'];
	
	if(isset($_POST['domainsID'])){
		if($session_data['drop_down_domainsID']) $session_data['ModsPermArr']=GetModulesPermissions();
	}
	//-----------------------------------------------------------------------------------------------------------	
	// Set language
	//-----------------------------------------------------------------------------------------------------------
	try{
		
		//$r->Initialise_Remote_Server(true);
		//$head_r=&$r;
		$sql="SELECT id,Name FROM languages ORDER BY Name";
		//$r->test_mysql($sql);
		//print "\n\n 876501------|--".$sql."--|----|--\n<br>";
		$rslt=$r->rawQuery($sql);
		//$data=$r->Fetch_Array($rslt);
		//print "\n\n 8765------|--".$sql."--|--".var_export($rslt,true)."--|-".var_export($data,true)."--|\n<br>";
		//print "9900876----------|--".$sql."--|--\n<br>";

		//print_r($session_data);


		//$r->test_mysql_db_result($rslt);
		//print "99008765----------|--".var_export($rslt,true)."--|--\n<br>";
		$LanguageCount=$r->NumRows($rslt);
		//print "99008765----------|--".$LanguageCount."--|--\n<br>";
		//for($x=0;$x<$LanguageCount;$x++){
		if($LanguageCount>0){
			while($data=$r->Fetch_Array($rslt)){
				//print "8765----------|--".var_export($data,true)."--|--\n<br>";
				//print_r($data);
				//$data=$r->Fetch_Array();
				//print "\n\n8765----------|--".var_export($data,true)."--|--\n";
				$LanguageName=$data[1];
				if(!is_numeric($session_data['drop_down_languagesID'])){

					$session_data['drop_down_languagesID']=$data[0];
					//echo"--1111-\n\n";
				} 
				if($data[0]==$session_data['drop_down_languagesID']){
					$selected=1;
				}else{
					$selected=0;
				}
				//$tmp=($data[0]==$session_data['languagesID'] ? "selected" : "");
				//$tmp=($data[0]==$session_data['languagesID'] ? true : false);
				$app_data['languages'][]=array("id"=>$data[0],"name"=>$LanguageName,"selected"=>$selected);
				//echo"<option value='$data[0]' $tmp>$LanguageName</option>";
			
			};
		}else{
			//print "\n\n5678\n\n----------|--".var_export($data,true)."--|--\n\n\n";
		}
		
	}catch(Exception $e){
		//print_r($e);
	}
	//print_r($app_data);
	//-----------------------------------------------------------------------------------------------------------	
	// Set domain
	//-----------------------------------------------------------------------------------------------------------
	try{
		//echo"--4321-\n\n";
		//$r->Initialise_Remote_Server(true);
		//echo"--43210-\n\n";
		$domain_name="sitemanage.info";
		$app_data['remote_server']=array();
		$app_data['remote_server']['domain_name']=$domain_name;
		//exit("languages3");
		echo"--x1234---|-".var_export($session_data,true)."-|-\n\n";
		/*
		if(isset($session_data['drop_down_domainsID'])){
			if(is_numeric($session_data['drop_down_domainsID'])){
		*/		
				echo"--1234999-\n\n";
				//$sql="SELECT domains.Name,ClientsID FROM domains WHERE domains.id='".$session_data['drop_down_domainsID']."'";
				$sql="SELECT domains.Name,ClientsID FROM domains WHERE domains.Name='".$domain_data['domain_Name']."'";
				
				$rslt=$r->rawQuery($sql);
				$data=$r->Fetch_Array($rslt);
				echo"--yyy12345----|--".$sql."---|-".var_export($data,true)."-|---\n\n";
				$num_rows=$r->NumRows($rslt);
				//echo"--12345432100----|--".$num_rows."---|-".var_export($data,true)."-|---\n\n";
				if($num_rows>0){
					if(is_array($data)){
						echo"--123454321----|--".$sql."---|DDD-".var_export($data,true)."-|---\n\n";
						$domain_name=$data[0];
						$app_data['remote_server']['domain_name']=$domain_name;
						$domain_id=0;
						$session_data['drop_down_clientsID']=$data[1];
						$app_data['drop_down_clientsID']=$data[1];
						// ------------------------- access remote server installation
						$r->Set_Current_Server($domain_name);
						//echo"--4321-\n\n";
						$sql="SELECT domains.id FROM domains WHERE domains.Name='".$domain_name."'";
						//print $sql;
						//print "\n\n".$sql."\n\n";
						$rslt=$r->rawQuery($sql);
						$data=$r->Fetch_Array();
						//echo"--4445-\n\n".$domain_id;
						//print_r($data);
						if($r->NumRows()>0){
							$domain_id=$data[0];
							$session_data['domainsID']=$domain_id;
							$app_data['domainsID']=$domain_id;
							//echo"--4333-\n\n".$domain_id;
						}
					}
					
				}
				/*
			}else{
				//echo"--2222-\n\n";
			}
			
			
		};
		*/
		//$session_data['clientsID']=$session_data['drop_down_domainsID'];

	}catch(Exception $e){
		//print_r($e);
	}
	
	//echo"--4445-\n\n";
	//print_r($session_data);
	$_COOKIE=$session_data;
	//echo"--4111-\n\n";
	//print_r($_COOKIE);
	//-----------------------------------------------------------------------------------------------------------	
	$domain_name="sitemanage.info";
	$app_data['domains_populate']['search_sql']="";
	$sql="";
	//print_r($session_data);
	try{
		//$r->Initialise_Remote_Server(true);
		if(isset($session_data['drop_down_clientsID'])){
			if(isset($session_data["SU"])){
				if($session_data["SU"]!="No"){
				
					$sql="SELECT domains.id,SiteTitle,Name as Host,mirrorID FROM domains WHERE clientsID=".$session_data['drop_down_clientsID']." ORDER BY Name";
				
				}else{
					
					if(isset($session_data['administratorsID'])){
						$sql="SELECT domains.id,SiteTitle,Name as Host,mirrorID FROM domains,administrators_domains ";
						$sql.="WHERE domains.id=administrators_domains.domainsID AND administratorsID=".$session_data['administratorsID']." AND clientsID=".$session_data['drop_down_clientsID'];
						$sql.=" ORDER BY Name";
					}else{
						$sql="SELECT domains.id,SiteTitle,Name as Host,mirrorID FROM domains WHERE id=666";
					}
					
				}
			}
			
			
		}else{
			if(!$session_data['drop_down_clientsID']){
				$sql="SELECT domains.id,clientsID FROM domains WHERE id=".$session_data['drop_down_domainsID']." LIMIT 0,1";
				$rslt=$r->rawQuery($sql);
				$data=$r->Fetch_Array();
				$session_data['drop_down_clientsID']=$data[1];
				$app_data['drop_down_clientsID']=$data[1];
			}
			
		}
		$app_data['domains_populate']['search_sql']=$sql;
		//-----------------------------------------------------------------------------------------------------------	
		
		
		if($sql!=""){
			$rslt=$r->rawQuery($sql);
			//print "\n\n -- 5554321--".$sql."----|--".var_export($app_data,true)."-|--\n\n";
			$num_rows=$r->NumRows($rslt);
			//print "\n\n -- 555--".$num_rows."\n\n";
			if($num_rows>0){
				//$data=$r->Fetch_Array($rslt);
				//print "\n\n -- 55500--".$sql."\n\n";
				while($data=$r->Fetch_Array($rslt)){
					//print "\n\n -- 54321--".$sql."----|--".var_export($data,true)."-|--\n\n";
					/*
					if(isset($session_data['drop_down_domainsID'])){
						if(!is_numeric($session_data['drop_down_domainsID'])){
							$session_data['drop_down_domainsID']=$data[0];
							//echo"--11114-\n\n";
							$selected=true;
						}
					}else{
						$session_data['drop_down_domainsID']=$data[0];
						$selected=true;
						//echo"--11115-\n\n";
					}
					*/
					$selected=($data[0]==$session_data['domainsID'] ? 1 : 0);
					//$tmp=($data[0]==$session_data['domainsID'] ? true : false);
					//$app_data['domains'][]=array($data[0]=>$data[1],"url"=>$data[2],"selected"=>$tmp);
					//print "\n\n -- 5554321--".$sql."----|--".var_export($data,true)."-|--\n\n";
					
					// below new
					$dval=$data[1]." -> ".$data[2];
					$app_data['domains'][]=array("id"=>$data[0],"title"=>$dval,"mirrorID"=>$data[3],"selected"=>$selected);
					// end new

					//echo"<option value='$data[0]' $tmp>$data[1] -> $data[2]</option>";
					//print "\n\n -- 5554321--".$sql."----|--".var_export($data,true)."-|--\n\n";
				};
				//echo"--14414-\n\n";
			}
		
		}
		
	//$session_data['ModsPermArr']=GetModulesPermissions();
	}catch(Exception $e){
		//print_r($e);
	}
	//print "\n\n -- 5552--".$sql."\n\n";
	//print_r($app_data);
	//-----------------------------------------------------------------------------------------------------------	
	
	try{
		//print "\n\n -- 5551234--".$sql."\n\n";
		
		//$r->Initialise_Remote_Server(true);
		if(isset($session_data["SU"])){
			if($session_data["SU"]=="CWL"){ 
				$sql="SELECT id,Name FROM clients ORDER BY Name";
				
				$rslt=$r->RawQuery($sql);
				
				$client_count=$r->NumRows($rslt);
				print "\n\n -- 555123456--".$client_count."-".var_export($session_data,true)."-\n\n";
				if($client_count>0){
					while($data=$r->Fetch_Array($rslt)){
						//$tmp=($data[0]==$session_data['clientsID'] ? true : false);
						//$app_data['clients'][]=array($data[0]=>$data[1],"selected"=>$tmp);
						//$app_data['clients'][]=array($data[0]=>$data[1]);
						$selected=($data[0]==$session_data['clientsID'] ? 1 : 0);
						$app_data['clients'][]=array("id"=>$data[0],"title"=>$data[1],"selected"=>$selected);
						//echo"<option value='$data[0]' $tmp>$data[1]</option>";
					};
				}
				//print "\n\n -- 1234555123456--n\n";
				//print_r($app_data);
			}
		}
		
		
	}catch(Exception $e){
		//print_r($e);
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
	//print "\n\n -- 55533--".$sql."\n\n";
	

	//-----------------------------------------------------------------------------------------------------------					
	
	
	//exit();
	//$domain_name=$app_data['remote_server']['domain_name'];
	/* removed 2023-03-19
	$domain_name="localhost";
	$r->Set_Current_Server($domain_name);
	 removed 2023-03-19 */
	//print "$$-".$domain_name."--\n";
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
	//print "\n\n -- 5554400--".var_export($session_data,true)."\n\n";
	//print "\n\n -- 55544--".var_export($app_data,true)."\n\n";


	//$_COOKIE=$session_data;
	echo"\n\n000108001234----------------------------||-------------------------------------------------\n\n";
	print_r($app_data);
    ///print_r($_SESSION);
?>