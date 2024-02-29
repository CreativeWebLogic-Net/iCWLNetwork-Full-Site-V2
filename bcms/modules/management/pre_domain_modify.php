<?php
	include("../../Admin_Start_Include.php");

//print_r($app_data['domains']);

	$app_data['delete_domain']=array();
	if(isset($_POST['Delete'])){
		if($_POST['Delete']=="Delete"){
      $delete_id_array=$_POST['DFiles'];
      
			//if(is_array($_POST['DFiles'])){
      if(is_array($delete_id_array)){
        //---delete from sitemanage--------------------------------------------------------------------------";
        $r->Initialise_Remote_Server(true);
				$m= new DeleteFromDatabase($log);
        $m->Set_Database($r);
				$m->AddIDArray($_POST['DFiles']);
				$m->AddTable("domains");
				$Errors=$m->DoDelete();
        $Errors="";
				if($Errors==""){
					$Message="Web Sites Deleted";
				}else{
					$Message=$Errors;
				};
        
        //------get remote domain info-----------------------------------------------------------------------------------------------------
        $count=0;	
        //print "\n$$101-".var_export($_POST['DFiles'],true)."--\n";
        $id_array=$delete_id_array;
        $app_data['delete_domain']=array();
        foreach($delete_id_array as $key=>$val){
          //print "\n$$166855-".$val."--".$key."-".$count."--\n";
          
          $id_array[$key]=$val;
          //print "$$10199-".var_export($delete_id_array,true)."--\n";
          $sql="SELECT id AS domainsID,Name AS Host,serversID FROM domains WHERE id='".$val."'";
          $rslt=$r->rawQuery($sql);
          //print "\n$$10119-".$val."--".$sql."--\n";
          
          if($r->NumRows()>0){
            //print "$$101-".$data."--".$sql."--\n";
            $data=$r->Fetch_Assoc();
            //print "\n$$171-".var_export($data,true)."--".$r->current_link."--\n";
            //print_r($data);
            $delete_local_domain_data=$data;
            $app_data['delete_domain'][$count]=$delete_local_domain_data;
            
            //------get remote domain info-----------------------------------------------------------------------------------------------------	
            $remote_host=$delete_local_domain_data['Host'];
            //print "\n4444-".$remote_host."--\n";
            

            $remote=new clsRetrieveRecords($log);
            $remote->CreateDB();
            $remote->Set_Vs($vs);

            $remote->Set_Current_Server($remote_host);
            $sql2="SELECT id AS remote_domainsID,Name AS remote_Host,serversID AS remote_serversID FROM domains WHERE Name='".$remote_host."'";
            $rslt2=$remote->rawQuery($sql2);
            
            if($remote->NumRows()>0){
              
              $remote_data=$remote->Fetch_Assoc();
              $app_data['delete_domain'][$count]=array_merge($delete_local_domain_data, $remote_data);
              //print "\n$$1000-".var_export($remote_data,true)."--".$sql2."--\n";
              //$delete_domain_data = array_merge($delete_local_domain_data, $remote_data);
              //$delete_domain_data=$remote_data;

              //print_r($app_data['delete_domain']);
              //$app_data['delete_domain'][$count]=$delete_domain_data;
              //print_r($app_data['delete_domain']);
              
              $count++;
            }else{
              //print "\n$$7777777-no domain found->".$val."--".$sql2."--".$remote->current_link."--\n";
              $remote_data=array();
              $delete_domain_data =array();
            }
            
            
            //$r->Set_Current_Server($delete_domain_data['Host']);
            /*
            print_r($app_data['delete_domain']);
            $app_data['delete_domain'][]=$delete_domain_data;
            print_r($app_data['delete_domain']);\*/
            //$count++;
          }else{
            //print "$$171334-select error-".var_export($data,true)."--".$sql."-".$count."--\n";
            //print "\n$$88888-no home domain found->".$val."--".$sql."--".$r->current_link."---\n";
          }
          
        }
        //print "\n$$11111111-".var_export($app_data['delete_domain'],true)."----\n";
        //---delete from remote server--------------------------------------------------------------------------";
        
        foreach($app_data['delete_domain'] as $key=>$val){
          //$Domain_Name=$val['remote_Host'];
          if(count($val)>3){
            $m= new DeleteFromDatabase($log);
            $m->Set_Database($r);
            $m->Set_Remote_Database($val['remote_Host']);
            $m->ClearID();
            $m->AddID($val['remote_domainsID']);
            $m->AddTable("domains");
            $Errors=$m->DoDelete();
            $Errors="";
            if($Errors==""){
              $Message="Web Sites Deleted";
            }else{
              $Message=$Errors;
            };
          }
          
        }
        //-----------------------------------------------------------------------------------------------------------	
        //echo"--3334-\n\n";
        //print $sql;
        //print_r($app_data);
        $rslt=$r->rawQuery($app_data['domains_populate']['search_sql']);
        if($r->NumRows()>0){
          $app_data['domains']=array();
          while($data=$r->Fetch_Array()){
            $dval=$data[1]." -> ".$data[2];
            $app_data['domains'][]=array($data[0]=>$dval);
          };
        }
			}else{
				$Message="No Web Sites Selected To Delete";
			};
		};
	};
  /*
  print_r($app_data['delete_domain']);
	print_r($app_data['domains']);
  */
?>