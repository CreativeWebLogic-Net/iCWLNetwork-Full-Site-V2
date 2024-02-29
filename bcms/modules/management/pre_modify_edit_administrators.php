<?php
	//include("../../Admin_Start_Include.php");
	
	
	//$r= new ReturnRecord();  // base object for returning data or raw queries
	
	if(isset($_POST['Submit'])){
    if($_POST['Submit']){
      $m= new UpdateDatabase($log);
      $m->Set_Database($r);
      $m->AddPosts($_POST,$_FILES);
      $m->AddSkip(array("id"));
      $m->AddTable("administrators");
      $m->AddID($_POST['id']);
      $m->DoStuff();
      $Message="Administrator Updated";
      
      $r->RawQuery("DELETE FROM administrators_domains WHERE administratorsID=$_POST[id]");
      if(isset($_POST['domainsID'])){
          foreach($_POST['domainsID'] as $key=>$val){
            $r->RawQuery("INSERT INTO administrators_domains (administratorsID,domainsID) VALUES ($_POST[id],$val)");
          }
      }
      
      
    };
  }
	
	if(isset($_GET['id'])){
    $id=$_GET['id'];
  }else{
    $id=0;
  }
	if (isset($_POST['id'])) $id=$_POST['id'];
	
	
	
	
	$r->AddTable("administrators");
	$r->AddSearchVar($id);
	$Insert=$r->GetRecord();
	$DomArr=array();
	$sql="SELECT domainsID FROM administrators_domains WHERE administratorsID=".$id;
	//print $sql;
	$rslt=$r->RawQuery($sql);
	if($rslt){
		if($r->NumRows($rslt)>0){
			while($myrow=$r->Fetch_Array($rslt)){
				$DomArr[]=$myrow[0];
			}
		}
	}
	//print_r($DomArr);
?>