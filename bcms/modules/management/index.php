<?php
	
	//
  //echo"0001----------------------------||-------------------------------------------------\n\n";

  if(isset($_GET['file'])){
    $file_name=$_GET['file'];
    header("Location: http://assets.localhost/".$file_name);
  }
	
	$load_file="./Admin_Start_Include.php";
  if(file_exists($load_file)){
    //echo"23322332111----------------------------||-------------------------------------------------\n\n";
	    include_once($load_file);
  }else{
    //echo"23322332----------------------------||-------------------------------------------------\n\n";
  }
  //echo"0002----------------------------||-------------------------------------------------\n\n";
	//print_r($session_data);
	
	$login=false;
	
	if(isset($_GET['Message']))$Message=$_GET['Message'];
	if(isset($_GET['hash'])){
		$login=true;
		$sql="UPDATE administrators SET administratorActive=1 WHERE hash='".$_GET['hash']."'";
		$data=$r->rawQuery($sql);
		$sql="SELECT * FROM administrators where hash='".$_GET['hash']."' LIMIT 0,1";
	}

  //print_r($_POST);
	
	if(isset($_POST['Submit'])){
		if($_POST['Submit']!=""){
			$login=true;
			//$r=new ReturnRecord();
			$sql="SELECT * FROM administrators where username='$_POST[UserName]' and password='$_POST[Password]' AND administratorActive=1 LIMIT 0,1";
			//print $sql;
			
		}
	}

	if($login){
    //echo"\n\n0000----------------------------||-------------------------------------------------\n\n";
		$data=$r->rawQuery($sql);
    //print_r($data);
    //echo"\n\n0001----------------------------||-------------------------------------------------\n\n";
		//$dataarray=$r->Fetch_Array($data);
    $dataarray=$r->Fetch_Array($data);
		//print_r($dataarray);
    //echo"\n\n0002----------------------------||-------------------------------------------------\n\n";
	
		if(isset($dataarray[0])){
			if($dataarray[0]>0){ //admin login ok
				
				$session_data["administratorsID"]=$dataarray[0];
				$session_data["SU"]=$dataarray[6];
				$session_data["clientsID"]=$dataarray[7];
				$session_data["username"]=$dataarray[3];

				$session_data['original_clientsID']=$session_data["clientsID"];//$dataarray[2];
				$session_data['original_administratorsID']=$session_data["administratorsID"];//$dataarray[0];
				//echo"\n\n0002----------------------------||-------------------------------------------------\n\n";
		   // print_r($session_data);
				//$r=new ReturnRecord();
				if($session_data["SU"]=="CWL"){
					$sql="SELECT MIN( domains.id) FROM domains WHERE  clientsID=".$session_data['clientsID'];
				}else{
					$sql="SELECT MIN( domains.id) FROM domains,administrators_domains WHERE domains.id=administrators_domains.domainsID";
					$sql.=" AND administratorsID=$session_data[administratorsID] AND clientsID=$session_data[clientsID]";
				}
				
				//print "-\n\n-".$sql."-\n\n-";
				$rslt=$r->RawQuery($sql);
				if($rslt){
					if($r->NumRows($rslt)>0){
						$data=$r->Fetch_Array($rslt);
            //print($data[0]);
						if($data[0]>0){
							$session_data['original_domainsID']=$data[0];
              $_COOKIE['original_domainsID']=$data[0];
							//$session_data['domainsID']=$data[0];
							//print_r($session_data);
						}
					}
				}
        //echo"\n\n0003----------------------------||-------------------------------------------------\n\n";
        //print_r($session_data);
				//exit();
        $_SESSION=$session_data;
        
				$loc="Location: main/logged-in/index.php";
        //---------------------------2023-07-04-----------------------------
				header($loc);
        
        //---------------------------2023-07-04-----------------------------
				//print $loc;
			}else{	//admin login bad
				$Message="Incorrect Username or Password";
			};
		}else{
      //echo"\n\n0003-----|-".$sql."-|-------|-".var_export($data,true)."-|--------------------|-".var_export($dataarray,true)."-|------------------------------------------------0003-\n\n";
	
			$Message="Incorrect Username or Password";
			
		}

	}
  //echo"\n\n0004----------------------------||-------------------------------------------------\n\n";
	//print_r($session_data);
  //$_COOKIE=$session_data;
  //print_r($_COOKIE);
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Bubble CMS Lite Administration</title>
<link href="https://f005.backblazeb2.com/file/iCWLNet-Website-Assets/admin/css/management.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript" type="text/JavaScript">function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
	return true ;
else
	return false ;
}</script>

<body>
<?php include("./main/includes/empty-header.php");?>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
  <tr>
    <td width="179" valign="top" class="ManagementContentLeftColumn"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0" class="ManagementContentLeftColumnLinks">
      <tr>
        <td height="10">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="leftside">
          <?php include("./main/includes/submenu-login.php");?>
        </span></td>
      </tr>
    </table></td>
    <td valign="top" class="rightbg">
      <br />
      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>
		  <?php
		if(isset($session_data["administratorsID"])){
			
	?>
  <!--
	We are redireting you into managment, <a href="main/logged-in/index.php">Click Here</a> To Manually Forward.
			<script>
			location.href = "main/logged-in/index.php";
			</script>
    -->
	<?php
			
		}else{
	?>	
	<form name="form1" method="post" action="">
			

      <table  border="0" align="center" cellpadding="0" cellspacing="0">
       
        <tr>
          <td align="center" ><table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><table  border="0" align="center" cellpadding="0" cellspacing="6" class="ManagementLoginBox">
				<tr>
                      <td height="20" colspan="2" align="center" ><span class="blacktextbold">Welcome to Creative Web Logic's Website Builder</span></td>
                      </tr>
                  <tr>
                      <td height="20" colspan="2" align="center" ><span class="RedText"><?php print $Message; ?></span></td>
                      </tr>
                    <tr>
                      <td width="130" height="20" align="right" ><span class="blacktextbold"><strong>Username:</strong> &nbsp;</span> </td>
                      <td width="212"><input name="UserName" type="text" class="loginfield" id="UserName"></td>
                    </tr>
                    <tr>
                      <td  width="130" height="20" align="right"><span class="blacktextbold"><strong>Password:</strong> &nbsp;</span> </td>
                      <td><input name="Password" type="password" class="loginfield" id="Password"></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center">
					  <input name="Login_Code" type="hidden" value="123456789"> 	
					  <input name="Submit" type="submit" class="loginbutton" value="Login"> <a href="register.php">Register</a>
					</td>
                      </tr>
                    
                </table>
				
				</td>
              </tr>
          </table></td>
		  <td>
		  
		  </td>
        </tr>
        
        
      </table>
      
      </form>
		  
<?php
		}
	  ?>
		</td>
        </tr>
        
      </table></td>
  </tr>
</table>
<?php include("./main/includes/footer.php");?>
</body>
</html>
<?php 
  include("./main/includes/end-of-file.php");

  //echo"000231----------------------------||-------------------------------------------------\n\n";
	//print_r($session_data);
?>