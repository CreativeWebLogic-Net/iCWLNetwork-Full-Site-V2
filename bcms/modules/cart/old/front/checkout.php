<?
	session_start();
	include("../DB_Class.php");
	$r=new ReturnRecord();
	
	$m= new ReturnRecord();
	$m->AddTable("Preferences");
	$m->AddSearchVar(1);
	$Insert=$m->GetRecord();
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
<script>
<!--
var Country=<?=$Insert['Country']?>;

function setDelivery(CID){
	//alert(Country+" "+CID+" "+document.frmCheckout.DN.value+" "+document.frmCheckout.DI.value);
	if(Country==CID){
		document.getElementById("Delivery").innerHTML=document.frmCheckout.DN.value;
		document.getElementById("FinalTotal").innerHTML=Math.round(((document.frmCheckout.Total.value*1)+(document.frmCheckout.DN.value*1))*1.1,2);
		document.getElementById("GSTRow").style.display="";
	}else{
		document.getElementById("Delivery").innerHTML=document.frmCheckout.DI.value;
		document.getElementById("FinalTotal").innerHTML=Math.round((document.frmCheckout.Total.value*1)+(document.frmCheckout.DI.value*1),2);
		document.getElementById("GSTRow").style.display="none";
	}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
      if (t==1){ //fromto
        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
      } else if (t==2){
        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
      } else if (t==3){ // date
        ma=a[i+1].split("#");at=v.match(ma[0]);
        if(at){
          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
          dte=new Date(cy,cm,cd);
          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
        }else{err=true}
      } else if (t==4){ // time
        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
      } else if (t==5){ // check this 2
            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!o1.checked){err=true}
      } else if (t==6){ // the same
            if(v!=MM_findObj(a[i+1]).value){err=true}
      }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
          at = a[i].match(/(.*)\[(\d+)\].*/i);
          o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+s)}
  document.MM_returnValue = (s=='');
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
                        
            <div align="center">
			<p align="center">* Mandatory Fields </p>              
              <form action="buy.php" method="post" name="frmCheckout" id="frmCheckout" onSubmit="YY_checkform('frmCheckout','checkbox','#q','1','You must agree to the Terms and Conditions.','FName','#q','0','You must fill in a First Name.','LName','#q','0','You must fill in a Last Name.','Email','#S','2','You must fill in a valid Email Address.','StreetAddress','#q','0','You must fill in a Street Address.','Suburb','#q','0','You must fill in a Suburb.','City','#q','0','You must fill in a City.','State','#q','0','You must fill in a State.','Postcode','#q','0','You must fill in a Post/Zipcode');return document.MM_returnValue">
                <table width="80%"  border="0" cellpadding="3" cellspacing="1" id="ProductRow">
                  
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*First Name</strong></td>
                    <td width="65%" align="left"><input name="FName" type="text" id="FName" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*Last Name </strong></td>
                    <td align="left"><input name="LName" type="text" id="LName" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*Email</strong></td>
                    <td align="left"><input name="Email" type="text" id="Email" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>Company Name </strong></td>
                    <td align="left"><input name="CompanyName" type="text" id="CompanyName" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>Phone</strong></td>
                    <td align="left"><input name="Phone" type="text" id="Phone" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*Street Address </strong></td>
                    <td align="left"><input name="StreetAddress" type="text" id="StreetAddress" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*Suburb</strong></td>
                    <td align="left"><input name="Suburb" type="text" id="Suburb" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*City</strong></td>
                    <td align="left"><input name="City" type="text" id="City" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*State</strong></td>
                    <td align="left"><input name="State" type="text" id="State" size="45"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td align="left"><strong>*Post/Zipcode</strong></td>
                    <td align="left"><input name="Postcode" type="text" id="Postcode" size="10"></td>
                  </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td width="35%" align="left"><strong>*Country</strong></td>
                    <td align="left"><select name="Country" onChange="setDelivery(this.value)">
                      <?
				  	$sql=$r->rawQuery("SELECT id,name FROM country");
					while($myrow=mysql_fetch_row($sql)){
						if($Insert['Country']==$myrow[0]){
							echo "<option value='$myrow[0]' selected>$myrow[1]</option>";
						}else{
							echo "<option value='$myrow[0]'>$myrow[1]</option>";
						};
					}
				  ?>
                    </select></td>
                    </tr>
                  <tr bgcolor="#C6C6CD" >
                    <td height="21" align="left"><strong>*Agree To Terms And Conditions </strong></td>
                    <td align="left"><input type="checkbox" name="checkbox" value="checkbox">
                      <a href="javascript:MM_openBrWindow('popup/terms.htm','tandc','width=550,height=350')" >CLICK HERE</a> to view </td>
                  </tr>
                </table>
                <br>
                <br>
                <table width="80%"  border="0" cellpadding="3" cellspacing="1" id="ProductRow">
                  <tr bgcolor="#C6C6CD" >
                    <td width="36%"><strong>Name</strong></td>
                    <td><strong>Description</strong></td>
                    <td><strong>Price</strong></td>
                    <td><strong>Amount</strong></td>
                    <td width="9%"><strong>Sub Total </strong></td>
                    </tr>
                  <?
					$Count=0;
					$Total=0;
					if(is_array($_SESSION['Products'])){
						foreach($_SESSION['Products'] as $ID => $Amount){
							$r=new ReturnRecord();
							$sq2=$r->rawQuery("SELECT id,Image,Name,SDesc,Price,ShippingN,ShippingI FROM Products WHERE id='$ID'");  
							while ($myrow = mysql_fetch_row($sq2)) {
								$Count++;
								$Total+=$myrow[4]*$Amount;
								$DTotalN+=$myrow[5]*$Amount;
								$DTotalI+=$myrow[6]*$Amount;
								?>
                  <tr bgcolor="<?=(($Count%2)==0 ? "#CECECE" : "#E5E5E5"); ?>" >
                    <td><?=$myrow[2]?></td>
                    <td width="38%"><?=$myrow[3]?></td>
                    <td width="8%" align="left">AU$<?=number_format($myrow[4],2)?></td>
                    <td width="9%" align="left"><?=$Amount?></td>
                    <td align="center">AU$<?=number_format($Amount*$myrow[4],2)?></td>
                    </tr>
                  <?
							};
						};
					};
				?>
                  <tr bgcolor="#C6C6CD"  >
                    <td colspan="4" align="right">Total</td>
                    <td>AU$<?=number_format($Total,2)?></td>
                  </tr>
                  <tr bgcolor="#C6C6CD"  >
                    <td colspan="4" align="right">Delivery Total</td>
                    <td>AU$<span id="Delivery"><?=number_format($DTotalN,2)?></span></td>
                  </tr>
                  <tr bgcolor="#C6C6CD"  id="GSTRow">
                    <td colspan="4" align="right"><input name="Total" type="hidden" id="Total" value="<?=$Total?>">                      <input name="DN" type="hidden" id="DN" value="<?=$DTotalN?>">
                      <input name="DI" type="hidden" id="DI" value="<?=$DTotalI?>">
                      GST </td>
                    <td>AU$<?=number_format(($Total+$DTotalN)/10,2)?> </td>
                  </tr>
                  <tr bgcolor="#C6C6CD"  >
                    <td colspan="4" align="right">Final Total </td>
                    <td>AU$<span id="FinalTotal"><?=number_format(($Total+$DTotalN)*1.1,2);?></span> </td>
                  </tr>
                  <tr bgcolor="#405175"  >
                    <td colspan="5"><div align="right">
                      <input type="submit" name="Submit" value="Pay Now">
</div></td>
                  </tr>
                </table>
                <br>  
                <table width="80%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="74%"><a href="javascript:MM_openBrWindow('popup/refund.htm','tandc','width=550,height=400')" >CLICK HERE</a> to view refund policy. </td>
                    <td width="26%"><img src="../images/paypal_logo.gif" width="200" height="50"></td>
                  </tr>
                </table>
              </form>
              <div align="right"></div>
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

