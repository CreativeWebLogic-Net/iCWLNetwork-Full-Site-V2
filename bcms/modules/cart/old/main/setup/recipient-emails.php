<?php
	include("../../Admin_Start_Include.php");
	
	$r= new ReturnRecord();  // base object for returning data or raw queries
	
	if($_POST['Submit']){
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("AdminEmails");
		$m->AddID(1);
		$m->DoStuff();
		$Message="Emails Updated";
	};
	
	
	$m= new ReturnRecord();
	$m->AddTable("AdminEmails");
	$m->AddSearchVar(1);
	$Insert=$m->GetRecord();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>DAlc.info Shopping Cart Administration</title>
<link href="../../css/management.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
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
    <td height="245" valign="top" class="rightbg">
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
          <td><form action="recipient-emails.php"  method="post" name="form2" >
              <span class="pageheading">Recipient Emails </span><span class="RedText"><?php print $Message; ?></span><br>
                <br>
          The Recipient Email addresses listed below are used to receive management emails.<br>
          <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
                <tr>
                  <td width="122"><strong> Form name<span class="RedText"></span></strong></td>
                  <td width="513"><strong>Email Address</strong></td>
                </tr>
                <tr>
                  <td> General </td>
                  <td><input name="General" type="text" class="formfield1" id="General" value="<?php print $Insert['General']; ?>"></td>
                </tr>
                <tr>
                  <td> Invoices </td>
                  <td><input name="Invoices" type="text" class="formfield1" id="Invoices" value="<?php print $Insert['Invoices']; ?>"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="Submit" type="submit" class="formbuttons" value="Update" onClick="return confirmSubmit()"></td>
                </tr>
              </table>
          </form></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
