<?php
	
	

	
	//echo"000-----------------------------------------------------------------------------\n";
	
	$current_domain= str_replace("www.", "",$_SERVER['HTTP_HOST']);
	$tag_match_array=array("url"=>$current_domain);
	include("includes/start-of-header-functions.php");
	
	//ob_start("callback_cms_start");
	//ob_start("callback_all");
	//exit("Use Cached File");
	//ob_start("callback");
	
	//echo"<br>0001-----------------------------------------------------------------------------\n <br>";
	
	
	
	

	
	//ob_start("callback"); now above
	
	//----------------------------------------------------------------
	// root data types
	//----------------------------------------------------------------
	$module_data=array();
	$module_data['db']=array();
	$domain_user_data=array();
	$domain_data=array();
	$domain_data['db']=array();
	$app_data=array();
	$template_data=array();
	$template_data['db']=array();
	$content_data=array();
	$content_data['db']=array();
	$text_data=array();
	$text_data['db']=array();
	$bizcat_data=array();
	$sidebar_data=array();
	$news_data=array();
	$content_domain_data=array();
	//--------------------------------------------------
	$current_dir=pathinfo(__DIR__);
	$app_data['current_dir']=$current_dir;
	//print_r($current_dir);
	//echo"0001-----------------------------------------------------------------------------\n";
	//----------------------------------static asset files------------------------------
	$app_data['asset-severs'][0]='https://assets.bubblecms.biz/'; // linode server
	$app_data['asset-severs'][1]='https://spaces.auseo.net/'; // digital ocean custom server
	$app_data['asset-severs'][2]='https://static-cms.nyc3.cdn.digitaloceanspaces.com/'; // digital ocean cdn server
	$app_data['asset-severs'][3]='https://static-cms.nyc3.digitaloceanspaces.com/'; //digital ocean standard server
	$app_data['asset-severs'][4]='https://assets.ownpage.club/'; //asura standard server
	$app_data['asset-severs'][5]='https://assets.hostingdiscount.club/'; //asura reseller server
	$app_data['asset-severs'][6]='https://assets.icwl.me/'; //hostgator reseller server
	$app_data['asset-severs'][7]='https://static-assets.w-d.biz/'; //cloud unlimited server
	$app_data['asset-severs'][8]='https://assets.i-n.club/'; //ionos unlimited server
	$app_data['asset-severs'][9]='https://assets.creativeweblogic.net/'; //ionos unlimited server
	$app_data['asset-severs'][10]='https://static-assets.site/'; //ionos unlimited server
	$app_data['asset-severs'][11]='https://f005.backblazeb2.com/file/iCWLNet-Website-Assets/';

	$app_data['asset-sever']=$app_data['asset-severs'][11];
	
	$app_data["include_callback"]="callback";
	//----------------------------------------------------------------
	//echo"xxx";
	//if(isset($_GET['cpid'])){
	$root_array=explode('/',$_SERVER['PHP_SELF']);
	//print_r($root_array);
	if($root_array[1]=="bcms"){
		$app_data['APPBASEDIR']='./';
		$app_data['ROOTDIR']='/bcms/';
	}else{
		$app_data['APPBASEDIR']='bcms/';
		$app_data['ROOTDIR']='/';
	}
	//echo"000101-----------------------------------------------------------------------------\n";
	$app_data['APPLICATIONSDIR']=$app_data['APPBASEDIR'].'apps';
	$app_data['MODULEBASEDIR']=$app_data['APPBASEDIR'].'modules/';
	$app_data['CLASSESBASEDIR']=$app_data['APPBASEDIR'].'classes/';
	$app_data['INCLUDESBASEDIR']=$app_data['APPBASEDIR'].'includes/';
	//----------------------------------------------------------------
	//print"xx-".$current_dir['dirname'];
	//define('SERVERBASEDIR',$current_dir['dirname'].'/');
	//$app_data=array();
	$file_wrapper="include_wrapper.php";
	$filepath=$app_data['CLASSESBASEDIR']."clsLogger.php";
	include($file_wrapper);
	//$file_details=include_read($filepath);
	//include($filepath);
	
	
	global $log;
	$log = new clsLog();
	if(!isset($log)){
		exit("no log");
	}
	//$log->general("-aa app_content-".var_export($app_data,true),3);
	/*
	$filepath=$app_data['CLASSESBASEDIR']."clsOutputBuffer.php";
	if(file_exists($filepath)){
		include_once($filepath);
	}else{
		exit("Error");
	}
	*/
	//$ob_buffer = new clsOutputBuffer();
	//$ob_buffer->add_callback();
	//print $filepath;
	//echo"00010111-----------------------------------------------------------------------------\n";
	
	/*
	if(file_exists($filepath)){
		include_once($filepath);
	}else{
		exit("Error");
	}
	*/
	//echo"00010122-----------------------------------------------------------------------------\n";
	
	//define('APPBASEDIR','bcms/');
	//$filepath=APPBASEDIR."classes/clsLogger.php";
	
	//echo"xx2".$filepath;
	
	$log->general("To Train ",1);
	//echo"yyd";
	//echo"010-----------------------------------------------------------------------------\n";
	try{
		
		$log->general("First Constants",1);

	//	$log->general("-app_content-".var_export($app_data,true),3);
		
		$log->general("Logger Loaded",1);
		//session_start();
		if(isset($_SESSION['membersID'])){
			$membersID=$_SESSION['membersID'];
		}else{
			$membersID=0;
		}
		try{
			//$log->general("-app_content-".var_export($app_data,true),3);
			
			//$db_file=$app_data['CLASSESBASEDIR']."clsDataBase.php";
			//$log->general("-db_file-".$db_file,3);
			//$file_details=include_read($db_file);
			$filepath=$app_data['CLASSESBASEDIR']."clsDataBase.php";
        	include($file_wrapper);
			//include($db_file);
			
			$log->general("-clsDb-Done-",3);
		}catch(Exception $e){
			$log->general("-clsDb Not Loaded-",3);
			throw new Exception('clsDb Failure.');
		}
		
		$log->general("\n",1);
		//include("classes/clsDB.php");
		$log->general("db loaded",1);
		//$log_text.="-x2cbx-";
		$log->general("-start-",1);
		
		//$inc_file=$app_data['CLASSESBASEDIR']."clsMail.php";
		//$file_details=include_read($inc_file);
		//include($inc_file);
		$filepath=$app_data['CLASSESBASEDIR']."clsMail.php";
        include($file_wrapper);
		$filepath=$app_data['CLASSESBASEDIR']."clsVariables.php";
		//$file_details=include_read($inc_file);
		include($file_wrapper);//include($inc_file);
		$filepath=$app_data['INCLUDESBASEDIR']."config.inc.php";
		//$file_details=include_read($inc_file);
		include($file_wrapper);//include($inc_file);
		$filepath=$app_data['INCLUDESBASEDIR']."functions.inc.php";
		//$file_details=include_read($inc_file);
		include($file_wrapper);//include($inc_file);
		
		//include("./tools/pgsql.php");
		//test_pgsql_new();
		
		$vs=new clsVariables();
		$vs->Set_Log($log);
		$log->general("-clsVariables Loaded-",1);
		
		$r=new clsDatabaseInterface($log);
		$r->Add_App_Data($app_data);
		$log->general("-clsDI Started-",1);
		$log->general("\n",1);
		$r->Set_Log($log);
		//test_pgsql();

		//echo"0-----------------------------------------------------------------------------\n";
		$log->general('Loading Create VS $r',1);
		$r->Set_Vs($vs);
		$log->general("\n",1);
		$log->general('Loading Create DB $r',1);
		//echo"11111-----------------------------------------------------------------------------\n";
		
		$log->general("\n",1);
		$r->CreateDB();
		//$r->test_pgsql();
		//$r->Initialise();
		$log->general("\n",1);
		
		//echo"--22222---------------------------------------------------------------------------\n";
		$log->general('Loading Set Vs Database $r',1);
		//$full_address=$r->current_dir;
		$log->general("\n",1);
		//$log->general("root_dir".$full_address);
		$log->general("\n",1);
		//echo"--33333---------------------------------------------------------------------------\n";
		
		//define('SITEFULLDIR',$full_address);
		$log->general("\n",1);
		$log->general("Set Root Dir",1);
		$log->general("\n",1);
		//$vs->AddReturnRecord($r);
		$log->general("Set DB Interface GUID->",1);
		//$vs->Look_GUID();
		$log->general("Loading Classes in index.php",1);
		//echo"--44444---------------------------------------------------------------------------\n";
		
		// all constants
		
		$log->general('Loading Modules ',1);
		
		//$dest_file=$app_data['MODULEBASEDIR']."domain/init.php";
		//$log->general("-Domain pre Load-".$dest_file,3);
		//print_r($domain_data);
		//$file_details=include_read($dest_file);
		//include($dest_file);
		$filepath=$app_data['MODULEBASEDIR']."domain/init.php";
		//$file_details=include_read($inc_file);
		include($file_wrapper);
		//include($dest_file);
		
		//$log->general("-Domain fin Load-".$dest_file,3);
		//echo"--45---------------------------------------------------------------------------\n";
		//$log->general("-Applications-".$domain_data['applicationsID'],1);
		
		$log->general("-Domain init Finished Loaded-",1);
		//echo"--512334---------------------------------------------------------------------------\n";
		
		//$dest_file=$app_data['MODULEBASEDIR']."language/init.php";
		//$file_details=include_read($dest_file);
		//include($dest_file);
		$filepath=$app_data['MODULEBASEDIR']."language/init.php";
		include($file_wrapper);
		$log->general("\n",1);
		$log->general("-Language Loaded-",1);
		
		//echo"--5-5--------------------------------------------------------------------------\n";
		
		//include($app_data['MODULEBASEDIR']."content/init.php");
		$filepath=$app_data['MODULEBASEDIR']."content/init.php";
		include($file_wrapper);
		$log->general("-123-Content Loaded",1);
		
		////echo"--6---------------------------------------------------------------------------\n";
		$menu_data['spacers']=true;
		
		//$dest_file=$app_data['MODULEBASEDIR']."template/init.php";
		//$file_details=include_read($dest_file);
		//include($dest_file);
		$filepath=$app_data['MODULEBASEDIR']."template/init.php";
		include($file_wrapper);
		//echo"\n\n-7--------------------------------------------------------\n\n";
		//echo"xxx2";
		$log->general("667-Template Loaded-",1);
		//print "jj\n\n<br><br>9998\n\n";
		//print_r($template_data);
		
	//	$dest_file=$app_data['MODULEBASEDIR']."language/definitions.php";
		//$file_details=include_read($dest_file);
		//include($dest_file);
		$filepath=$app_data['MODULEBASEDIR']."language/definitions.php";
		include($file_wrapper);
		
		$log->general("-Language Defs Loaded-",1);
		$log->general("-Define Some more Constants-",1);
		$log->general("\n",1);
		//echo"\n\n-8--------------------------------------------------------\n\n";
		$log->general("vs-AddAllVariables");
		//$vs->AddAllVariables();
		//$vs->Set_Database(DOMAINSID);$domain_data
		//$vs->Set_Database($domain_data["db"]['id']);
		//$vs->AddAllVariables();
		
		
		$log->general("-Add all variables into session class-\n\n\n",1);
		//$vs->AddByRefVariables("Classes",'log',$log);
		//$vs->AddByRefVariables("Classes",'r',$r);
		//$vs->AddByRefVariables("Classes",'vs',$vs);
		$log->general("-Loaded all Major Variables Loaded-",1);
		$log->general("\n",1);
		
		//echo"\n\n-9--------------------------------------------------------\n\n";
		//echo"xxx";
		try{
			//echo"\n\n-9--------------------------------------------------------\n\n";
			//print_r($template_data);print_r($domain_data);
			//ob_end_flush();
			$log->general("-Start line-",3);
			//$log->general("-Loaded template const",1);
			//$load_file=TEMPLATEPATH."/index.php";
			if(isset($template_data["db"]['dir'])){
				$template_data['My_Dir']=$app_data['APPBASEDIR']."templates/".$template_data["db"]['dir'];
				$load_file=$template_data['My_Dir']."/index.php";
				$log->general("-End line-".$load_file,3);
				//print $load_file;
				$log->general("-ar Loading Template->".$load_file,3);
				//echo"\n\n-10----".$load_file."----------------------------------------------------\n\n";
				if(file_exists($load_file)){
					//ob_end_flush();
					//ob_start("callback_template");
					//ob_start("callback_all");
					//$ob_buffer->add_callback();
					//include($load_file);
					$app_data["include_callback"]="callback_template";
					$filepath=$load_file;
		            include($file_wrapper);
					//ob_end_flush();
					//ob_start("callback_cms_end");
					//ob_start("callback_all");
					//$ob_buffer->add_callback();
				}else{
					throw new Exception('Template not loading.');
				}
			}else{
				exit("No Template File");
			}
			
			
			//echo"\n\n-11--------------------------------------------------------\n\n";
		}catch(Exception $e){
			$log->display_all();
	
			//$log->general("-After Page is Loaded-".var_export($e,true),1);
		}
		$log->general("-After Page is Loaded-",1);
		
	}catch(Exception $e){
		
	}
	//ob_end_flush();
	//$ob_buffer->output_callback();
	//ob_start("callback_everyone");
	//ob_end_flush();
	//print_r($html_piece);
?>