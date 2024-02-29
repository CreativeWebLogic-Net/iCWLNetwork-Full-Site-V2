<?php
	include("../../Admin_Start_Include.php");
	//$loggeneral("-admin members add -",1);
	//$r= new ReturnRecord();  // base object for returning data or raw queries
	//try{
    if(isset($_POST['Submit'])){
      //echo"yyy";

      /*
      public function Set_DB(&$db){
        $this->r =$db;
      }
      
      
      public function Set_Log(&$log){
        //$log=$log;
        //$log->general('M Log Success:',1);
      }
      
      public function Set_Vs(&$vs=false){
        $this->vs=$vs;
      }
      */
      //echo"10-----------------------------------------------------------".var_export($r,true)."------------------";
      
      $atd= new AddToDatabase($log);
      //echo"688-----------------------------------------------------------".var_export($r,true)."------------------";
      
     // $atd->Set_Log($log);
      $atd->Set_Database($r);
      //echo"689-----------------------------------------------------------".var_export($r,true)."------------------";
      
      $atd->Set_Vs($vs);
      $atd->AddPosts($_POST,$_FILES);
     // echo"690-----------------------------------------------------------".var_export($r,true)."------------------";
      
      $atd->AddTable("users");
      //echo"691-----------------------------------------------------------".var_export($r,true)."------------------";
      
      $atd->DoStuff();
      $NewID=$atd->ReturnID();
      
      /*
      if(isset($_POST['subdomain'])){
          $subdomain=$r->Escape($_POST['subdomain']);
      }else{
        $subdomain="";
      }
      
      if(isset($_POST['name'])){
          $name=$r->Escape($_POST['name']);
      }else{
          $name="";
      }
      if(isset($_POST['contact_name'])){
          $contact_name=$r->Escape($_POST['contact_name']);
      }else{
          $contact_name="";
      }
      if(isset($_POST['email'])){
        $email=$r->Escape($_POST['email']);
      }else{
        $email="";
      }
      if(isset($_POST['address'])){
        $address=$r->Escape($_POST['address']);
      }else{
          $address="";
      }
      if(isset($_POST['suburb'])){
        $suburb=$r->Escape($_POST['suburb']);
      }else{
          $suburb="";
      }
      if(isset($_POST['state'])){
        $state=$r->Escape($_POST['state']);
      }else{
          $state="";
      }
      if(isset($_POST['postcode'])){
          $postcode=$r->Escape($_POST['postcode']);
      }else{
          $postcode="";
      }
      if(isset($_POST['phone'])){
          $phone=$r->Escape($_POST['phone']);
      }else{
          $phone="";
      }
      if(isset($_POST['mobile'])){
          $mobile=$r->Escape($_POST['mobile']);
      }else{
          $mobile="";
      }
      if(isset($_POST['fax'])){
          $fax=$r->Escape($_POST['fax']);
      }else{
          $fax="";
      }
      if(isset($_POST['website'])){
        $website=$r->Escape($_POST['website']);
      }else{
          $website="";
      }
      if(isset($_POST['password'])){
        $password=$r->Escape($_POST['password']);
      }else{
          $password="";
      }
      if(isset($_POST['accesslvl'])){
          $accesslvl=$r->Escape($_POST['accesslvl']);
      }else{
          $accesslvl="";
      }
      if(isset($_POST['abn'])){
        $abn=$r->Escape($_POST['abn']);
      }else{
          $abn="";
      }
      if(isset($_POST['mod_business_categoriesID'])){
        $mod_business_categoriesID=$r->Escape($_POST['mod_business_categoriesID']);
      }else{
          $mod_business_categoriesID="";
      }
      if(isset($_POST['business_description'])){
          $business_description=$r->Escape($_POST['business_description']);
      }else{
          $business_description="";
      }
        

      $sql="INSERT INTO users (subdomain,name,contact_name,email,address,suburb,state,postcode,phone,mobile,";
      $sql.="fax,website,password,accesslvl,abn,mod_business_categoriesID,business_description)";
      $sql.=" VALUES (".$subdomain.",".$name.",".$contact_name.",".$email.",".$address.",".$suburb.",".$state.",".$postcode.",".$phone.",".mobile.",";
      $sql.=$fax.",".$website.",".$password.",".$accesslvl.",".$abn.",".$mod_business_categoriesID.",".$business_description.")";
      print $sql."<br>";
      //$loggeneral("1 In Add User->".$sql,3);
      $rslt=$r->RawQuery($sql);
      */
      
      $Message="Member Added";
    };
    if(!isset($Insert['accesslvl'])) $Insert['accesslvl']="";
    
    if(!isset($Insert['mod_business_categoriesID'])) $Insert['mod_business_categoriesID']=0;
    if(!isset($Insert['business_description'])) $Insert['business_description']="";


    
?>