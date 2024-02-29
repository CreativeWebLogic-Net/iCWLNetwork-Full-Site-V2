<?php
	$templatesID=0;
	$domains_templatesID=0;
	//set sql result non capitalized
	//print_r($content_data);
	
	if(isset($content_data["db"])){
		
		if(isset($content_data["db"]['templatesID'])){
			if($content_data["db"]['templatesID']==0){
				if(isset($domain_data["db"]['templatesID'])){
					if($domain_data["db"]['templatesID']>0){
						$templatesID=$domain_data["db"]['templatesID'];
					}else{
						$templatesID=0;
					}				
				}else{
					$templatesID=0;
				}
			}else{
				$templatesID=$content_data["db"]['templatesID'];
			}			
		}elseif(isset($domain_data["db"]['templatesID'])){
			if($domain_data["db"]['templatesID']>0){
				$templatesID=$domain_data["db"]['templatesID'];
			}else{
				$templatesID=0;
			}
		
		}else{
			$templatesID=0;
		}
		
		//if content page has a custom template then overwrite the domain template
		if($templatesID>0){
			$sql="SELECT * FROM templates WHERE id='".$templatesID."'";
			$rslt=$r->RawQuery($sql);
			$num_rows=$r->NumRows($rslt);
			if($num_rows>0){
				$template_data["db"]=$r->Fetch_Assoc($rslt);
			
				$template_data["db"] = strip_capitals($template_data["db"]);
				if(count($template_data["db"])==0){
					exit("No Template->".$sql);
					$error_message="No template found=>".$sql;
					//echo $error_message;
					$log->general($error_message,3);
				}
				//echo "\n\n 123-------\n\n";
				//print_r($template_data);
				$template_data['TEMPLATEPATH']=$app_data['APPBASEDIR']."templates/".$template_data["db"]['dir'];
				$template_data['TEMPLATEDIR']=$template_data['TEMPLATEPATH'];
			}else{
				exit("No Template->".$sql);
			}
		}
		
		
		
		//echo "xxx";
	}
	
	
?>