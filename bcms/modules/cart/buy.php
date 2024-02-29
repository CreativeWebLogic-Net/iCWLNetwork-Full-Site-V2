<?php
	session_start();
	include("../DB_Class.php");
	include("../Mail_Class.php");
	$r=new ReturnRecord();
	
	if(($_POST['Submit'])&&(is_array($_SESSION['Products']))){
		$r->AddTable("Preferences");
		$r->AddSearchVar(1);
		$Insert=$r->GetRecord();
		
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("OrderDetails");
		$m->DoStuff();
		$NewID=$m->ReturnID();
		$Items="";
		$EmailBody="Thank you for your order when your payment is verified thye goods below will be sent to you shortly";
		$EmailBody.="<table id=\"ProductRow\"  width=\"80%\">
						<tr bgcolor=\"#C6C6CD\" >
							<td width=\"36%\"><strong>Name</strong></td>
							<td><strong>Description</strong></td>
							<td><strong>Price</strong></td>
							<td><strong>Amount</strong></td>
                    	</tr>";
						
		$DeliveryTotal=0;
		$GoodsTotal=0;
		$Total=0;
		if(is_array($_SESSION['Products'])){
			foreach($_SESSION['Products'] as $ID => $Amount){
				$r=new ReturnRecord();
				$sq2=$r->rawQuery("SELECT id,Image,Name,SDesc,Price,ShippingN,ShippingI,ProductCode FROM Products WHERE id='$ID'");  
				while ($myrow = mysql_fetch_row($sq2)) {
					if($Insert['Country']==$_POST['Country']){
						$Delivery=$myrow[5];
						$DeliveryTotal+=$Amount*$Delivery*1.1;
						$GoodsTotal+=$Amount*$myrow[4]*1.1;
					}else{
						$Delivery=$myrow[6];
						$DeliveryTotal+=$Amount*$Delivery;
						$GoodsTotal+=$Amount*$myrow[4];
					}
					
					$Total+=($Amount*$Delivery)+($Amount*$myrow[4]);
					$GSTTotal+=(($Amount*$Delivery)+($Amount*$myrow[4]))*0.1;
					$Items.=$myrow[2];
					$EmailBody.="<tr>
									<td>$myrow[2]</td>
									<td>$myrow[3]</td>
									<td>$myrow[4]</td>
									<td>$Amount</td>
								</tr>";
					
					$r->rawQuery("INSERT INTO ProductOrders (OrderDetailsID,Name,SDesc,Price,Delivery,Amount,ProductCode) 
					VALUES ('$NewID','$myrow[2]','$myrow[3]','$myrow[4]','$Delivery','$Amount','$myrow[7]')");
				};
			
			};
			
		};
		
		if(1==$_POST['Country']) $Total*=1.1; // Add GST
		
		$EmailBody.="<tr bgcolor=\"#C6C6CD\">
						<td colspan=\"3\" align=\"right\">Delivery Total</td>
						<td>$".number_format($DeliveryTotal,2)."</td>
					</tr>
					<tr bgcolor=\"#C6C6CD\">
						<td colspan=\"3\" align=\"right\">Goods Total</td>
						<td>$".number_format($GoodsTotal,2)."</td>
					<tr>";
		if(1==$_POST['Country']){
			$EmailBody.="	<tr bgcolor=\"#C6C6CD\">
								<td colspan=\"3\" align=\"right\">GST Total</td>
								<td>$".number_format($GSTTotal,2)."</td>
							<tr>";
		};
		$EmailBody.="	<tr bgcolor=\"#C6C6CD\">
							<td colspan=\"3\" align=\"right\">Final Total</td>
							<td>$".number_format($Total,2)."</td>
						</tr>
				  </table>";
		$sq2=$r->rawQuery("SELECT Invoices FROM AdminEmails WHERE id='1'");  
		$AEmail = mysql_fetch_array($sq2);
		
		$m=new SendMail();
		$m->To(array($_POST['Name']=>$_POST['Email']));
		$m->From("TOHO9000",$AEmail[0]);
		$m->Subject("Invoice");
		$m->Template("../emails/index.html");
		$m->Merge(array("Body"=>$EmailBody,"ServerUrl"=>$_SERVER['HTTP_HOST']));
		$m->Send();
		
		unset($_SESSION['Products']);
		$_SESSION['Invoice']=$NewID;
	};
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

</head>

<body onLoad="document.frmBuy.submit()">

<center>
<table width="749" border="0" cellpadding="0" cellspacing="0" class="main_border">
  <!--DWLayoutTable-->
  <tr>
    <td height="18" colspan="2" valign="top"><img src="../../Pics/toho9000layout2_02.gif" width="662" height="18" align="right"></td>
    <td width="86" background="../../Pics/link_background_top.gif" class="top-links"><span class="main_menu"><a href="../../index.html">Home</a> | <a href="../../sitemap.php">Sitemap</a></span> </td>
    </tr>
  <tr>
    <td height="139" colspan="2" valign="top"><img src="../../Pics/toho9000layout2_05.gif" width="662" height="139" align="right"></td>
    <td valign="top"><img src="../../Pics/toho9000layout2_06.gif" width="86" height="139"></td>
    </tr>
  <tr>
    <td width="494" height="22" valign="middle" background="../../Pics/menu_bg.gif" class="main_menu"><div align="left"><a href="../../index.html">Home</a> | <a href="../../Products.php">Products</a> | <a href="../../TestResults.htm">Tests</a> | <a href="../../SavingAnalysis.htm">Analysis</a> | <a href="../../Environment.php">Environment</a> | <a href="../../Research.htm">Research</a> | <a href="../../video.htm">Video</a> | <a href="order.php">Order Now</a> | <a href="../../ContactUs.php">Contact Us</a>   | <a href="../../links/index.php">Links</a></div></td>
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
            <p align="left">Thank you for your order you will now be transferred to our Credit Card Payment Gateway. </p>
            
            <div align="center">              
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frmBuy" id="frmBuy" >
                
                <input name="cmd" type="hidden" id="cmd" value="_xclick">
                <input name="amount" type="hidden" id="amount" value="<?=$GoodsTotal?>">
				<input name="currency_code" type="hidden" id="currency_code" value="AUD">
				<input name="handling" type="hidden" id="handling" value="<?=$DeliveryTotal?>">
                <input name="notify_url" type="hidden" id="notify_url" value="http://<?=$_SERVER['HTTP_HOST']?>/cart/front/PG_PayPal_Background.php">
				<input name="item_name" type="hidden" id="amount" value="<?=$Items?>">
                <input name="item_number" type="hidden" id="item_number" value="<?=$_SESSION['Invoice']?>">
				<input name="return" type="hidden" value="http://<?=$_SERVER['HTTP_HOST']?>/cart/front/success.php">
                <br>
                <input name="business" type="hidden" id="business" value="sweekim.ng@toho9000.com">
                <input type="submit" name="Submit" value="Click To Enter Payment Gateway">
                <br>
            </form>
            <script>
            document.frmBuy.submit();
            </script>
              
              
              
              
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

