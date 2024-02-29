<?php
    //echo"\n on server \n";
    //print_r($_GET);
    //print_r($_POST);

	if(isset($content_domain_data["db"])){
		if(count($content_domain_data["db"])>0){
			$content_data["db"]=$content_domain_data["db"];
		}
	}
	$log->general("-Content init Start->",1);
	if(!isset($_SESSION['membersID'])) $_SESSION['membersID']=0;
	$original_page=$_SERVER['REQUEST_URI'];
	$content_data["original_uri"]=$original_page;
	$content_data['cpid']=0;
	if(isset($_GET['cpid'])){
	    $content_data['cpid']=$_GET['cpid'];
	}elseif(isset($_POST['cpid'])){
	    $content_data['cpid']=$_POST['cpid'];
	}
	
	//print_r($content_data);
	
	if(isset($_GET['dcmsuri'])){
		$content_data["URI"]=$_GET['dcmsuri'];
		if($_GET['dcmsuri']){
			$PArr=explode("\?",$_GET['dcmsuri']);
			
		}else{
			$PArr=explode("\?",$original_page);
		}
		$content_data["proxy_uri"]=$content_data["URI"];
	}else{
		$content_data["URI"]="";
		$PArr=explode("\?",$original_page);
	}
	$content_data_uri=array();
	$content_data["dcmsuri"]=$_GET['dcmsuri'];
		if(isset($_GET['change'])){
			$content_data["change_datetime"]=urldecode($_GET['change']);
			$change_sql=" ,TIMESTAMPDIFF(HOUR,Changed,'".$content_data["change_datetime"]."') AS cache_count";
		}else{
			$change_sql="";
		}
		//if(isset($_GET['cpid'])){
		if(isset($content_data['cpid'])){
			//$content_data["content_pagesID"]=$_GET['cpid'
			$content_data["content_pagesID"]=$content_data['cpid'];
			if(isset($_GET['change'])){
				$sql='SELECT DISTINCT URI'.$change_sql.' FROM content_pages WHERE id='.$content_data["content_pagesID"].' LIMIT 0,1';
			}else{
				$sql='SELECT DISTINCT URI,Changed AS cache_count FROM content_pages WHERE id='.$content_data["content_pagesID"].' LIMIT 0,1';
			}
			$rslt=$r->RawQuery($sql);
			$num_rows=0;
			$num_rows=$r->NumRows($rslt);
			if($num_rows>0){
				if(isset($content_data["change_datetime"])){
					exit("Use Cached File");
				}else{
				}
				$content_data_uri=$r->Fetch_Assoc();
			}
			if(isset($content_data_uri['URI'])){
				$content_data["URI"]=$content_data_uri['URI'];
				$content_data["uri"]=$content_data["URI"];
			}
		}else{
			$content_data["content_pagesID"]=0;
			$content_data["uri"]=$content_data["URI"];
		}
	$content_data["uri_split_array"]=$PArr;
	if(!defined("TOTALPAGENAME")){
		define('RESET',true);
		$log->general("-Content Loading->",1);
		$TotalPageName=$PArr[0];
		define('TOTALPAGENAME',$TotalPageName);
		$content_data["TOTALPAGENAME"]=$TotalPageName;
	}
	$OriginalPageName=$TotalPageName;
	if(substr($TotalPageName,strlen($TotalPageName)-1)!="/"){
		$TotalPageName.="/";
	}
	$VariableArray=array();
	$csearch=true;
	$notfound=true;
	$csearch=true;
	$segment=0;// times we go around
	$log->general("-Content Biz Cats-",1);
			if(isset($domain_user_data)>0){
				if(count($domain_user_data)>0){
					if(isset($domain_data["db"]['id'])){
						$sql="SELECT * FROM content_pages WHERE module_viewsID='25' AND domainsID=".$domain_data["db"]['id']." AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
						$rslt=$r->RawQuery($sql);
						if($r->NumRows($rslt)>0){
							$csearch=false;
							$notfound=false;
							if(!defined("PAGENAME")){
								define('PAGENAME',$TotalPageName);
								$content_data["PAGENAME"]=$TotalPageName;
							}
							$content_data["db"]=$r->Fetch_Assoc($rslt);	
							if(isset($domain_user_data['mod_business_categoriesID'])){
								$sql="SELECT * FROM mod_business_categories WHERE id=".$domain_user_data['mod_business_categoriesID'];
						
								$rslt=$r->RawQuery($sql);
								$bizcat_data["db"]=$r->Fetch_Assoc($rslt);	
								
								$content_data["db"]['Meta_Title']=$domain_user_data['name']." - ".$bizcat_data['CategoryTitle']." - ".$content_data["db"]['Meta_Title'];
							}
							
						}
					}
					
				}
			}
			$sql="";
			if(isset($content_data["change_datetime"])){
				$change_sql=" ,TIMESTAMPDIFF(HOUR,Changed,'".$content_data["change_datetime"]."') AS cache_count";
				$change_sql_where=" AND cache_count<1";
			}else{
				$change_sql_where="";
				$change_sql="";
			}
			if(isset($domain_data["db"]["SEOFriendly"])){
				if($domain_data["db"]["SEOFriendly"]=="No"){
					if($content_data["content_pagesID"]>0){
						$sql="SELECT * FROM content_pages WHERE id='".$content_data["content_pagesID"]."'  LIMIT 0,1";

						$sql="SELECT *".$change_sql." FROM content_pages WHERE id='".$content_data["content_pagesID"]."'   LIMIT 0,1";
					}else{
						$sql="SELECT *".$change_sql." FROM content_pages WHERE  URI='".$content_data["URI"]."'  AND domainsID=".$domain_data['db']['id']."  LIMIT 0,1";
					}
				}elseif($domain_data["db"]["SEOFriendly"]=="Yes"){
					$sql="SELECT DISTINCT *".$change_sql." FROM content_pages WHERE URI='".$content_data["URI"]."'   AND domainsID=".$domain_data['db']['id']."";
					//print $sql;
					//print_r($domain_data);
				}
			}elseif($content_data["content_pagesID"]>0){
				$sql="SELECT *".$change_sql." FROM content_pages WHERE id='".$content_data["content_pagesID"]."'  LIMIT 0,1";
			}else{
				$sql="SELECT *".$change_sql." FROM content_pages WHERE HomePage='Yes'   LIMIT 0,1";
			}
			$rslt=$r->RawQuery($sql);
			$num_rows=0;
			$num_rows=$r->NumRows($rslt);
			
			if($num_rows>0){
			    //exit();
				
				$content_data['PAGENAME']=$OriginalPageName;
				$content_data['db']=$r->Fetch_Assoc($rslt);
				$content_data["content_pagesID"]=$content_data['db']['id'];
				$notfound=false;
				$csearch=false;
				if(isset($content_data['db']['cache_count'])){
					if($content_data['db']['cache_count']<0){
						exit("Use Cached File");
					}
				}
				//print_r($content_data['db']);
				//print_r($_SESSION);
				if($content_data['db']['Exposure']=="Member"){
				    if($_SESSION['membersID']==0){
				        $TotalPageName="/";
    				    $csearch=true;
				    }else{
				        $TotalPageName="/login/";
    				    $csearch=true;
				    }
				    $_SESSION['PAGENAME']=$content_data['PAGENAME'];
				}elseif($content_data['db']['Exposure']=="Admin"){
				    if(!isset($_SESSION["administratorsID"])){
				        $TotalPageName="/login-management/";
    				    $csearch=true;
				    }
				}
				/*
				if(($_SESSION['membersID']==0)&&($content_data['db']['Exposure']=="Member")){
				    $TotalPageName="/login/";
				    //define('PAGENAME',$TotalPageName);
				    $csearch=true;
    			    //echo"Member Page";
    			    //exit();
    				//header("Location: /");
    				$_SESSION['PAGENAME']=$content_data['PAGENAME'];
    				print_r($_SESSION);
    			}else{
    			    //define('PAGENAME',$OriginalPageName);
    			}
    			*/
			}else{
			}
			
			$log->general("-Content Search-",1);
			$domain_search=$domain_data['db']['id'];
			
			while($csearch){
			    
				$sql="SELECT * FROM content_pages WHERE URI='".$TotalPageName."' AND domainsID=".$domain_search." AND languagesID=".$_SESSION['LanguagesID']."";
				$rslt=$r->RawQuery($sql);
				$num_rows=$r->NumRows($rslt);
				
				if($num_rows>0){
					$csearch=false;
					$notfound=false;
					//if(!isset(PAGENAME)) define('PAGENAME',$TotalPageName);
					$content_data['PAGENAME']=$OriginalPageName;
					$content_data['db']=$r->Fetch_Assoc($rslt);	
					//print_r($content_data);
					if(!isset($_SESSION['membersID'])&&($content_data['db']['Exposure']=="Member")){
        			    //echo"Member Page";
        			    exit("Member Page");
        				//header("Location: /");
        			}
        			
        			if(!isset($_SESSION['administratorsID'])&&($content_data['db']['Exposure']=="Admin")){
        			    //echo"Admin Page";
        			    $TotalPageName='/login-management/';
        			    $csearch=true;
        			    //exit("Admin Page");
        				//header("Location: /");
        			}
					
				}else{
					//exit("XX Find Page=>".$sql."  <=>".$TotalPageName);
					$TArr=explode('/',$TotalPageName);
					$VariableArray[]=$TArr[count($TArr)-2];
					$TotalPageName="";
					for($x=0;$x<(count($TArr)-2);$x++){
						$TotalPageName.=$TArr[$x]."/";
					}
					if($TotalPageName=="/"){
					    if($domain_search>0){
					        $domain_search=0;
					        $csearch=true;
					        $TotalPageName=$OriginalPageName;
					    }else{
					        $csearch=false;
    						$content_data['PAGENAME']=$OriginalPageName;
    						define('PAGENAME',TOTALPAGENAME);
					    }
						
					}else{
						$csearch=true;
					}
					//print $TotalPageName;
				};
				
				//print "--".$sql."==";
			};
			//print_r($content_data);
			if($notfound){
				$sql="SELECT * FROM content_pages WHERE URI='".$content_data['PAGENAME']."' AND domainsID=".$domain_data["db"]['id']."";
				$rslt=$r->RawQuery($sql);
				if($r->NumRows($rslt)==0){// cant find page so load homepage for language/site
					$sql="SELECT * FROM content_pages WHERE URI='".$content_data['PAGENAME']."' AND domainsID=0";
					//print $sql;
					$rslt=$r->RawQuery($sql);
					$num_rows=$r->NumRows($rslt);
					if($num_rows>0){
						$content_data['db']=$r->Fetch_Assoc($rslt);
					}else{
						if($content_data["original_uri"]=="/"){
							// on homepage
							$sql="SELECT * FROM content_pages WHERE HomePage='Yes' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=".$domain_dat["db"]['id'];
						}elseif($content_data["original_uri"]!="/"){
							// on homepage
							$sql="SELECT * FROM content_pages WHERE URI='".$content_data['PAGENAME']."' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=0";
						}else{
							// when no page has been created - 404 error page
							$sql="SELECT * FROM content_pages WHERE module_viewsID='801'";
						}
						
						$rslt=$r->RawQuery($sql);
						$num_rows=$r->NumRows($rslt);
						if($num_rows>0){
						    //http_response_code(404);
							$content_data['db']=$r->Fetch_Assoc($rslt);
						}
						//print $content_data['PAGENAME'];
						if($content_data['PAGENAME']!="/404.shtml"){
						    
                            //http_response_code(404);
							header("Location: /404.shtml");
						}
						
					}
				}else{
					$content_data['db']=$r->Fetch_Assoc($rslt);
					$_SESSION['LanguagesID']=$content_data['languagesID'];
				};
			};
	
	$content_data["db"] = strip_capitals($content_data["db"]);
	$sql="SELECT * FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data['db']['module_viewsid'];
	//$sql="SELECT * FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$module_viewsID;
	$rslt=$r->RawQuery($sql);
		$num_rows=$r->NumRows($rslt);
		if($num_rows==0){
			header("Location: /");
		}else{
			$module_data["db"]=$r->Fetch_Assoc($rslt);
			$module_data["db"] = strip_capitals($module_data["db"]);
			//print_r($module_data);
			//if($module_data["db"]['Pre_FileName']!=""){
				$pre_file=$module_data["db"]['pre_filename'];
			if($pre_file!=""){
				$lfile=$app_data['MODULEBASEDIR'].$module_data["db"]['Dir']."/".$pre_file;
				//print $lfile;
				if (file_exists($lfile)) {
					include($lfile);
				}else{

					echo"AA error";
				}
			}
			// check for member session
			if(!isset($_SESSION['membersID'])&&($content_data['Exposure']=="Member")){
			    echo"Member Page";
				//header("Location: /");
			}
		}
	if(isset($content_data["content_pagesID"])){
		$content_data["content_pagesid"]=$content_data["content_pagesID"];
	}
	
	$log->general("-End Content init->",1);
	if(isset($_GET['ajax'])){
	    $domain_data["db"]['templatesID']=35;
	    $content_data["db"]['templatesID']=35;
	}
	
?>