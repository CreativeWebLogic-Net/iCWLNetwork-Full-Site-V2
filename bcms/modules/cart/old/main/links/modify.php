<?php
	include("../../Admin_Start_Include.php");
	
	if($_POST['Delete']=="Delete"){
		if(is_array($_POST['DFiles'])){
			$m= new DeleteFromDatabase();
			$m->AddIDArray($_POST['DFiles']);
			$m->AddTable("LinkCategories");
			$Errors=$m->DoDelete();
			$m->AddTable("Links");
			$m->AltDeleteVar("LinkCategoriesID");
			$Errors.=$m->DoDelete();
			if($Errors==""){
				$Message="Link Categories Deleted";
			}else{
				$Message=$Errors;
			};
		}else{
			$Message="No Link Categories Selected To Delete";
		};
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
    <td height="240" valign="top" class="rightbg">
	
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
          <td><form action="modify.php"  method="post" name="form2" >
              <span class="pageheading">Modify / Delete Link Categories </span><span class="RedText"><?php print $Message; ?></span><br>
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="table">
                <tr bgcolor="#363E57" id="tablecell">
                  <td class="tabletitle"> Name</td>
                  <td width="1%" align="center" class="tabletitle">Modify</td>
                  <td width="1%" align="center" class="tabletitle">Delete</td>
                </tr>
                <?php
					  	$Count=0;
					 	$r=new ReturnRecord();
						$sq2=$r->rawQuery("SELECT id,Name FROM LinkCategories");  
						while ($myrow = mysql_fetch_row($sq2)) {
						?>
                <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
                  <td><?=$myrow[1];?></td>
                  <td align="center"><a href="modify-edit.php?id=<?=$myrow[0];?>"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                  <td><div align="center">
                      <input type="checkbox" name="DFiles[]" value="<?=$myrow[0];?>">
                  </div></td>
                </tr>
                <?
							$Count++;
						};
					?>
                <tr align="right" bgcolor="#F2960D">
                  <td colspan="2">&nbsp;</td>
                  <td align="center"><input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">
                  </td>
                </tr>
              </table>
              <strong><br>
        To Delete an Link Categories:</strong> select the checkbox for that Link Category and then choose Delete button. <br>
        <strong>Tip:</strong> You can select multiple Link Categories. <br>
          </form></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
