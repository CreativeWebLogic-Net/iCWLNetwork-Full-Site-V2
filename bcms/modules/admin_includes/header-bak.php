<div id="ManagementHeader">
	
	<div id="ManagementHeaderRightColumn">
    	<?php
		/*
		$head_r=$r;
		$sql="SELECT id,Name FROM languages ORDER BY Name";
			$rslt=$head_r->rawQuery($sql);
			//print $sql;
			$LanguageCount=$r->NumRows($rslt);
		*/
		?>
        
        <div id="ManagementHeaderLanguageSelection" <?php print($LanguageCount==1 ? "class='hidden'" : "");?>>
        	<form action="../logged-in/index.php" method="post" name="frmLanguages" id="frmLanguages">
                <strong class="whitetextbold">Language: </strong>
                <select name="languagesID" id="languagesID" onChange="this.form.submit()">
					<?php
                        /*
						try{
							for($x=0;$x<$LanguageCount;$x++){
								//while($data=$r->Fetch_Array()){
							
								$data=$r->Fetch_Array();
								$LanguageName=$data[1];
								if(!isset($session_data['languagesID'])) $session_data['languagesID']=$data[0];
								$tmp=($data[0]==$session_data['languagesID'] ? "selected" : "");
								echo"<option value='$data[0]' $tmp>$LanguageName</option>";
							
							};
						}catch(Exception $e){
							//print_r($e);
						}
						*/
						/*
						print_r($app_data['languages']);
						$selected_key=$session_data['languagesID'];
						$drop_array=$app_data['languages'];
						foreach($drop_array as $key=>$val){
							foreach($val as $key2=>$val2){
								//print "-1-".$key2."--\n\n";
								//print "-2-".var_export($val,true)."--\n\n";

								print "-3-".$key2."--\n\n";
								print "-4-".$val2."--\n\n";
								$tmp=($val[0]==$selected_key ? "selected" : "");
							
								echo"<option value='".$key2."' ".$tmp.">".$val2."</option>";
							}
						}
						*/
						$selected_key=$session_data['original_languagesID'];
						$drop_array=$app_data['languages'];
						foreach($drop_array as $key=>$val){
							foreach($val as $key2=>$val2){
								$tmp=($key2==$selected_key ? "selected" : "");
								echo"<option value='".$key2."' ".$tmp.">".$val2."</option>";
							}
						}
                    ?>
                </select>
              </form>
        </div>
        <div id="ManagementHeaderWebsiteSelection">
        	<form action="../logged-in/index.php" method="post" name="frmClients" id="frmClients">
          <span class="whitetextbold">Website:</span>
          <select name="domainsID" id="domainsID" onChange="this.form.submit()">
            <?php
				/*
				$domain_name="sitemanage.info";
				if($session_data["SU"]!="No"){
					$sql="SELECT domains.id,SiteTitle,Name as Host FROM domains WHERE clientsID=$session_data[clientsID] ORDER BY Name";
				}else{
					$sql="SELECT domains.id,SiteTitle,Name as Host FROM domains,administrators_domains WHERE domains.id=administrators_domains.domainsID AND administratorsID=$session_data[administratorsID] AND clientsID=$session_data[clientsID] ORDER BY Name";
				}
				//print $sql;
				
				$rslt=$head_r->rawQuery($sql);
				if($r->NumRows()>0){
					while($data=$r->Fetch_Array()){
						if(!isset($session_data['domainsID'])){
							$session_data['domainsID']=$data[0];
						}
						/*
						if(!$session_data['domainsID']){
							$session_data['domainsID']=$data[0];
							//$session_data['ModsPermArr']=GetModulesPermissions();
						}
						*//*
						$tmp=($data[0]==$session_data['domainsID'] ? "selected" : "");
						echo"<option value='$data[0]' $tmp>$data[1] -> $data[2]</option>";
					};
				}
				*/
				//$r->Set_Current_Server($Domain_Name);
				
				//echo"\n<br>---------------------------\n";
				//$session_data['ModsPermArr']=GetModulesPermissions();
				//echo"\n<br>---------------------------\n";
				//print_r($session_data);
				/*
				foreach($app_data['domains'] as $key=>$val){
					$tmp=($val[0]==$session_data['domainsID'] ? "selected" : "");
							//print "-1-".var_export($key,true)."--\n\n";
							//print "-2-".var_export($val,true)."--\n\n";
							//echo"<option value='".$val[0]."' ".$tmp.">".$val[1]."</option>";
					//$tmp=($key==$session_data['domainsID'] ? "selected" : "");
					echo"<option value='".$val[0]."' ".$tmp.">".$val[1]."</option>";
				}
				*/
				$selected_key=$session_data['original_domainsID'];
				$drop_array=$app_data['domains'];
				foreach($drop_array as $key=>$val){
					foreach($val as $key2=>$val2){
						$tmp=($key2==$selected_key ? "selected" : "");
						echo"<option value='".$key2."' ".$tmp.">".$val2."</option>";
					}
				}
			?>
          </select>
        </form>
        </div>
        <div id="ManagementHeaderClientSelection">
        	<?php
				if($session_data["SU"]=="CWL"){ ?>
        <form action="../logged-in/index.php" method="post" name="frmClients" id="frmClients2">
          <span class="whitetextbold">Client:</span>
          <select name="clientsID" id="clientsID" onchange="this.form.submit()">
            <?php
				/*
					$sql="SELECT id,Name FROM clients ORDER BY Name";
				
				$rslt=$head_r->rawQuery($sql);
				if($r->NumRows()>0){
					while($data=$r->Fetch_Array()){
						$tmp=($data[0]==$session_data['clientsID'] ? "selected" : "");
						echo"<option value='$data[0]' $tmp>$data[1]</option>";
					};
				}
				*/

				/*
				$sql="SELECT id,Name FROM clients ORDER BY Name";
				
				$rslt=$head_r->RawQuery($sql);
				if($head_r->NumRows()>0){
					while($data=$r->Fetch_Array()){
						$tmp=($data[0]==$session_data['clientsID'] ? "selected" : "");
						echo"<option value='$data[0]' $tmp>$data[1]</option>";
					};
				}
				*/
				/*
				
				foreach($app_data['clients'] as $key=>$val){
					//$tmp=($data[0]==$session_data['clientsID'] ? "selected" : "");
					//echo"<option value='".$key."' ".$tmp.">".$val."</option>";
					$tmp=($val[0]==$session_data['clientsID'] ? "selected" : "");
					echo"<option value='".$val[0]."' ".$tmp.">".$val[1]."</option>";
				}
				*/

				$selected_key=$session_data['original_clientsID'];
				$drop_array=$app_data['clients'];
				foreach($drop_array as $key=>$val){
					foreach($val as $key2=>$val2){
						$tmp=($key2==$selected_key ? "selected" : "");
						echo"<option value='".$key2."' ".$tmp.">".$val2."</option>";
					}
				}
			?>
          </select>
        </form><?php };?>
        </div>
        <div id="ManagementHeaderLoggedIn" class="whitetextbold">
        	<?php
				print "Connected Server: ".$r->server_name." / ";
			?>
            <?php if($LanguageCount<2){ ?>
				<span id="ManagementHeaderLanguageDisplay" <?php print($LanguageCount==1 ?  "class='whitetextbold'" :  "class='redwarningtextbold'");?>>
        			<?php 
						if($LanguageCount==1){
							?>Current language: <?php print $LanguageName;?> / <?php
						}else{
							?>WARNING YOU NEED TO ADD A LANGUAGE<?php
						}
					?>
        		</span>
            <?php }; ?>
            Logged in as: <?php print $session_data["username"];?>
        </div>
    </div>
    <div style="clear:both">
    </div>
</div>
