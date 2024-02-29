<?php
	include("../../Admin_Start_Include.php");

	if($_POST['Submit']){
		$m= new ReturnRecord();
		$m->AddTable("Administrators");
		$m->AddSearchVar($_SESSION['AdminKey']);
		$Insert=$m->GetRecord();
		
		if($_POST['CPassword']==$Insert['Password']){
			$m= new UpdateDatabase();
			$m->AddPosts($_POST,$_FILES);
			$m->AddTable("Administrators");
			$m->AddID($_SESSION['AdminKey']);
			$m->DoStuff();
			$Message="Password Updated";
		}else{
			$Message="Current Password Incorrect";
		}
	};
	
	


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>DAlc.info Shopping Cart Administration</title>
<link href="../../css/management.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
	return true ;
else
	return false ;
}
//-->
</script>
</head>

<body onLoad="P7_TMclass();P7_TMopen()"><!-- #BeginLibraryItem "/Library/management-top1.lbi" --><table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="179"><img src="../../images/logo.gif" width="179" height="75"></td>
    <td valign="bottom"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right">&nbsp;</td>
        <td class="sitename">TOHO 9000 </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td class="loggedin">&nbsp;</td>
      </tr>
      <tr>
        <td width="63%" align="right"><img src="../../images/top.gif" width="27" height="20"></td>
        <td width="37%" bgcolor="#F2960D" class="loggedin"><strong>You are logged in as:</strong> 
		<?php
						//output administrator name
						$r=new ReturnRecord();
						$data=$r->rawQuery("SELECT UserName FROM Administrators WHERE id='$_SESSION[AdminKey]'");
						$dataarray=mysql_fetch_array($data);
						echo $dataarray[0];
					?>
		</td>
      </tr>
    </table></td>
  </tr>
</table><!-- #EndLibraryItem --><!-- #BeginLibraryItem "/Library/management-top2.lbi" -->
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="../../images/top-2.gif">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="right" bgcolor="#363E57">&nbsp; </td>
  </tr>
</table>
<!-- #EndLibraryItem --><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
  <tr>
    <td width="179" valign="top" bgcolor="#EEEEEE"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10">&nbsp;</td>
        </tr>
        <tr>
          <td><span class="leftside">
            <?php
			include("../../menu.php");  
		?>
          </span></td>
        </tr>
    </table></td>
    <td height="228" valign="top" class="rightbg">
	
      <table width="100%"  border="0" cellpadding="1" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
          <td height="10" bgcolor="#F2960D"></td>
        </tr>
        <tr>
          <td height="14" background="../../images/content-bg.gif"></td>
        </tr>
      </table>
      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><form action="password.php"  method="post" name="form2" >
              <span class="pageheading">Change Your Password </span><span class="RedText"><?php print $Message; ?></span><br>
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                <tr>
                  <td width="170"><strong> Current Password</strong></td>
                  <td width="465"><input name="CPassword" type="text" class="formfield1" id="CPassword"></td>
                </tr>
                <tr>
                  <td><strong>New Password</strong></td>
                  <td><input name="Password" type="text" class="formfield1" id="Password"></td>
                </tr>
                <tr>
                  <td><strong>Retype New Password</strong></td>
                  <td><input name="Password2" type="text" class="formfield1" id="Password2"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="Submit" type="submit" class="formbuttons" value="Save" onClick="return confirmSubmit()"></td>
                </tr>
              </table>
         
          </form></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
