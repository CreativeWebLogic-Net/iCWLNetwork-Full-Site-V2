<?php
	include("../../Admin_Start_Include.php");
	if(isset($_GET['Delete'])){
    if($_GET['Delete']=="Disable"){
      if(isset($_GET['DFiles'])){
        if(is_array($_GET['DFiles'])){
          $m= new BulkDBChange();
          $m->Set_Database($r);
          $m->AddIDArray($_GET['DFiles']);
          $m->WhatToChange("status","Rejected",false);
          $m->AddTable("users");
          $Errors=$m->DoChange();
          
          if($Errors==""){
            $Message="Accounts Disabled";
          }else{
            $Message=$Errors;
          };
        }else{
          $Message="No Accounts Selected To Disable";
        };
      }
    };

    if($_GET['Delete']=="Enable"){
      if(isset($_GET['DFiles'])){
        if(is_array($_GET['DFiles'])){
          $m= new BulkDBChange();
          $m->Set_Database($r);
          $m->AddIDArray($_GET['DFiles']);
          $m->WhatToChange("status","Approved",false);
          $m->AddTable("users");
          $Errors=$m->DoChange();
          
          if($Errors==""){
            $Message="Accounts Enabled";
          }else{
            $Message=$Errors;
          };
        }else{
          $Message="No Accounts Selected To Disable";
        };
      };
    };
  };
	
	
	
	
	
	if(isset($_GET['SText'])) $SText=$_GET['SText'];
	elseif (isset($_POST['SText'])) $SText=$_POST['SText'];
	if(isset($_GET['SType'])) $SType=$_GET['SType'];
	elseif (isset($_POST['SType'])) $SType=$_POST['SType'];
	if(isset($_GET['OType'])) $OType=$_GET['OType'];
	elseif (isset($_POST['OType'])) $OType=$_POST['OType'];
	else $OType="id";
	if(isset($_GET['OOType'])) $OOType=$_GET['OOType'];
	elseif (isset($_POST['OOType'])) $OOType=$_POST['OOType'];
	else $OOType="ASC";
	if(isset($_GET['NumRows'])) $NumRows=$_GET['NumRows'];
	elseif (isset($_POST['NumRows'])) $NumRows=$_POST['NumRows'];
	else $NumRows=10;
	if(isset($_GET['Page'])) $Page=$_GET['Page'];
	elseif(isset($_POST['Page'])) $Page=$_POST['Page'];
	else $Page=1;
	
  $SearchSQL="";
	$RecordsPerPage=$NumRows;
	$DynField="email";
	if(!empty($SText)){
		$SearchSQL="AND $SType LIKE '%$SText%'";
		if(($SType!="id")&&($SType!="name")) $DynField=$SType;
	};
	
	
	$SQL1="SELECT COUNT(*) FROM users,mod_business_categories ";
  $SQL1.="WHERE users.mod_business_categoriesID=mod_business_categories.id ";
  //$SQL1.="AND domainsID=".$session_data['domainsID']." ".$SearchSQL;
  $SQL1.="AND domainsID=0 ".$SearchSQL;
  //$SQL1="SELECT COUNT(*) FROM users,mod_business_categories WHERE users.mod_business_categoriesID=mod_business_categories.id AND domainsID=$session_data[domainsID] $SearchSQL";
	
  $rset=$r->rawQuery($SQL1);
  
	$rdata=$r->Fetch_Array($rset);
	if(isset($rdata[0])) $rcount=$rdata[0];
  else $rcount=0;
  
	$MaxPages=ceil($rcount/$RecordsPerPage);
	if($Page>$MaxPages) $Page=$MaxPages;
	$StartRecord=($Page-1)*$RecordsPerPage;
	if($StartRecord<0) $StartRecord=0;
	$SQL2="SELECT users.id,users.name,$DynField,status FROM users,mod_business_categories";
  $SQL2.=" WHERE users.mod_business_categoriesID=mod_business_categories.id ";
  $sql_domains="AND domainsID=$session_data[domainsID]";
  $sql_domains2="AND domainsID=0";
  $SQL3=$SQL2;
  $SQL2.=$sql_domains." $SearchSQL  ORDER BY $OType $OOType LIMIT $StartRecord,$RecordsPerPage";
  $SQL3.=$sql_domains2." $SearchSQL  ORDER BY $OType $OOType LIMIT $StartRecord,$RecordsPerPage";
	$rset=$r->rawQuery($SQL2);
  
  $SQL_table=$SQL2;
  //print $SQL2."\n\n<br>";
  $nrows=$r->NumRows();
  if($nrows<1){
    $rset=$r->rawQuery($SQL3);
    $nrows=$r->NumRows();
    $rcount=$nrows;
    if($nrows<1){
      $rcount=0;
    }else{
      $SQL_table=$SQL3;
    }
    
  }
  print "numrows=>".$nrows."--\n\n".$SQL3;
 
  if(!isset($SText)) $SText="";
  if(!isset($SType)) $SType="";
  if((isset($NumRows))&&(isset($SType))&&(isset($OType))&&(isset($OOType))&&(isset($SText))){
	  $NPPage="NumRows=".$NumRows."&SType=".$SType."&OType=".$OType."&OOType=".$OOType."&SText=".urlencode($SText);
  }else{
    $NPPage="";
  }
  $RecTo=($StartRecord+$RecordsPerPage);
	if($RecTo>$rcount) $RecTo=$rcount;
	
?>