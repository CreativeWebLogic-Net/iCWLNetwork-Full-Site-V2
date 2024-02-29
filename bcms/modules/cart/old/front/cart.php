<?
	session_start();
	include("../DB_Class.php");
	$r=new ReturnRecord();
	
	if($_POST['Submit']=="Order"){
		if(is_array($_POST['Products'])){
			foreach($_POST['Products'] as $ID=>$Amount){
				if($Amount>0){
					if($_SESSION['Products'][$ID]>0){
						$_SESSION['Products'][$ID]+=$Amount;
					}else{
						$_SESSION['Products'][$ID]=$Amount;
					}
				}
			}
		}
	}
	if($_POST['Submit']=="Change"){
		if(is_array($_POST['Products'])){
			foreach($_POST['Products'] as $ID=>$Amount){
				if($Amount==0){
					unset($_SESSION['Products'][$ID]);
				}else{
					$_SESSION['Products'][$ID]=$Amount;
				}
			}
		}
		if(is_array($_POST['Delete'])){
			foreach($_POST['Delete'] as $ID){
				unset($_SESSION['Products'][$ID]);
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to TOHO 9000</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image:  url(../../Pics/bg.gif);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	color: #5273A5;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #5273A5;
}
a:hover {
	text-decoration: none;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #5273A5;
}
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style4 {color: #000000}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<center>
<table width="749" border="0" cellpadding="0" cellspacing="0" class="main_border">
  <!--DWLayoutTable-->
  <tr>
    <td height="18" colspan="2" valign="top"><img src="../../Pics/toho9000layout2_02.gif" width="662" height="18" align="right"></td>
    <td width="86" background="../../Pics/link_background_top.gif" class="top-links"><span class="main_menu"><a href="../../index.html">Home</a> | <a href="../../site-map.html">Sitemap</a></span> </td>
    </tr>
  <tr>
    <td height="139" colspan="2" valign="top"><img src="../../Pics/toho9000layout2_05.gif" width="662" height="139" align="right"></td>
    <td valign="top"><img src="../../Pics/toho9000layout2_06.gif" width="86" height="139"></td>
    </tr>
  <tr>
    <td width="494" height="22" valign="middle" background="../../Pics/menu_bg.gif" class="main_menu"><div align="left"><a href="../../index.html">Home</a> | <a href="../../Products.php">Products</a> | <a href="../../TestResults.htm">Tests</a> | <a href="../../SavingAnalysis.htm">Analysis</a> | <a href="../../Environment.php">Environment</a> | <a href="../../Research.htm">Research</a> | <a href="../../video.htm">Video</a> | <a href="order.php">Order Now</a> | <a href="../../ContactUs.php">Contact Us</a>    | <a href="../../links/index.php">Links</a></div></td>
    <td colspan="2" valign="top" class="menu_right_bottom"><img src="../../Pics/toho9000layout2_08.gif" width="254" height="22"></td>
    </tr>
  <tr>
    <td height="274" colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td width="748" height="171" valign="top" bgcolor="#FFFFFF" class="content"><table width="97%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="62%"><span class="style2"><span class="style4">Order Online </span></span></td>
                <td width="38%"><a href="order.php">View Products</a> | <a href="cart.php">Your Shopping Cart</a> | <a href="checkout.php">Checkout </a></td>
              </tr>
            </table>            <p align="left" class="style2">              <img src="../../Pics/dotted_Line.gif" width="725" height="1" align="top"></p>
            <p align="left">&nbsp;</p>            
            <div align="center">              
              <form name="form1" method="post" action="">
                <table width="589"  border="0" cellpadding="3" cellspacing="1" id="ProductRow">
                  
                  <tr bgcolor="#C6C6CD" >
                    <td width="144"><strong>Name</strong></td>
                    <td><strong>Description</strong></td>
                    <td><strong>Price</strong></td>
                    <td><strong>Amount</strong></td>
                    <td><strong>Delete</strong></td>
                  </tr>
				  <?
					$Count=0;
					$Total=0;
					if(is_array($_SESSION['Products'])){
						foreach($_SESSION['Products'] as $ID => $Amount){
							$r=new ReturnRecord();
							$sq2=$r->rawQuery("SELECT id,Image,Name,SDesc,Price FROM Products WHERE id='$ID'");  
							while ($myrow = mysql_fetch_row($sq2)) {
								$Count++;
								$Total+=$myrow[4]*$Amount;
								?>
								  <tr bgcolor="<?=(($Count%2)==0 ? "#CECECE" : "#E5E5E5"); ?>" >
									<td><?=$myrow[2]?></td>
									<td width="275"><?=$myrow[3]?></td>
									<td width="46">AU$<?=$myrow[4]?></td>
									<td width="46" align="center"><input name="Products[<?=$myrow[0]?>]" type="text" size="4" value="<?=$Amount?>"></td>
								    <td width="40" align="center"><input type="checkbox" name="Delete[]" value="<?=$myrow[0]?>"></td>
								  </tr>
								  <?
							};
						};
					};
				?>
                                  <tr bgcolor="#C6C6CD"  >
                                    <td colspan="2" align="right">TOTAL</td>
                                    <td colspan="3">$<?=$Total?></td>
                                  </tr>
                    <tr bgcolor="#405175"  >
                    <td colspan="5"><div align="right">
                      <input type="submit" name="Submit" value="Change">
                      <br>
                      <br>
                      <input name="Button" type="button" onClick="MM_goToURL('parent','checkout.php');return document.MM_returnValue" value="Checkout">
                    </div></td>
                  </tr>
                </table>
              </form>
            </div></td>
          </tr>
          <tr>
            <td height="70" valign="top"><img src="../../Pics/toho9000layout2_10.gif" width="748" height="70"></td>
          </tr>
          <tr>
            <td height="33" background="../../Pics/bottom_bg.gif" class="top-links"><div align="center" class="main_menu"><a href="../../index.html">Home</a> | <a href="../../Products.php">Products</a> | <a href="../../TestResults.htm">Tests</a> | <a href="../../SavingAnalysis.htm">Analysis</a> | <a href="../../Environment.php">Environment</a> | <a href="../../Research.htm">Research</a> | <a href="../../video.htm">Video</a> | <a href="order.php">Order Now</a> | <a href="../../ContactUs.php">Contact Us</a> | <a href="/privacy.html">Privacy Statement</a> </div></td>
          </tr>
            </table></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="168"></td>
    <td></td>
  </tr>
</table>
</center>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-2937594-2";
urchinTracker();
</script></body>
</html>

