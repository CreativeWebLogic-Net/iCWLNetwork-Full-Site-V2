<?php
	//session_start();
	//include("../DB_Class.php");
//	$r=new ReturnRecord();
	
	//r= new ReturnRecord();
	$r->AddTable("Preferences");
	$r->AddSearchVar(1);
	$Insert=$r->GetRecord();

	//echo "\n\n ===================================================================================== 777 \n\n";
	$membersID=$_SESSION['membersID'];
    //$r=new ReturnRecord();
	$r->AddTable("user_details");
  
	$r->AddSearchVar($_SESSION['membersID']);
	$Memb=$r->GetRecord();
	
	$user_details_array=array('name','address','suburb','state','postcode','abn','phone','mobile','fax','email','website','contact_name','password','business_description');
	foreach($user_details_array as $key=>$val){
	    if(!isset($Memb[$val])){
	        $Memb[$val]="";
	    } 
	}
	
?>
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

</script>


<table width="749" border="0" cellpadding="0" cellspacing="0" class="main_border">
  <!--DWLayoutTable-->
  
  <tr>
    <td height="274" colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td width="748" height="171" valign="top" bgcolor="#FFFFFF" class="content">
                        
            <div align="center">
			<p align="center">* Mandatory Fields </p>              
              <form action="buy.php" method="post" name="frmCheckout" id="frmCheckout" >
                <table width="391" border="0" alig-="left" cellpadding="3" cellspacing="1" bgcolor="#97C8F9">
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Name :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['name'];?></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Address :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['address'];?></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Suburb :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['suburb'];?></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">State :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['state'];?></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Postcode :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['postcode'];?></td>
        </tr>
        <tr  >
                    <td width="35%" align="left"><strong>*Country</strong></td>
                    <td align="left">
                      <?php
				  	$sql=$r->rawQuery("SELECT id,Country_Name FROM countries WHERE id=".$Memb['countryID']);
					$myrow=$r->Fetch_Array($sql);
					echo $myrow[1];
					
				  ?></td>
        
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Phone Number :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['phone'];?></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Mobile Number :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['mobile'];?></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Fax Number :</font></td>
          <td width='197' bgcolor="#FFFFFF"><?php print $Memb['fax'];?></td>
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
                  <?php
                  print_r($_SESSION['Products']);
					$Count=0;
					$Total=0;
					$DTotalN=0;
					$DTotalI=0;
					if(is_array($_SESSION['Products'])){
						foreach($_SESSION['Products'] as $ID => $Amount){
							//$r=new ReturnRecord();
							$sq2=$r->rawQuery("SELECT id,Image,Name,SDesc,Price,ShippingN,ShippingI FROM Products WHERE ProductCode='$ID'");  
							while ($myrow = $r->Fetch_Array($sq2)) {
								$Count++;
								$Total+=$myrow[4]*$Amount;
								$DTotalN+=$myrow[5]*$Amount;
								$DTotalI+=$myrow[6]*$Amount;
								?>
                  <tr bgcolor="<?php print (($Count%2)==0 ? "#CECECE" : "#E5E5E5"); ?>" >
                    <td><?php print $myrow[2];?></td>
                    <td width="38%"><?php print $myrow[3]; ?></td>
                    <td width="8%" align="left">AU$<?php print number_format($myrow[4],2); ?></td>
                    <td width="9%" align="left"><?php print $Amount; ?></td>
                    <td align="center">AU$<?php print number_format($Amount*$myrow[4],2);?></td>
                    </tr>
                  <?
							};
						};
					};
				?>
                  <tr bgcolor="#C6C6CD"  >
                    <td colspan="4" align="right">Total</td>
                    <td>AU$<?php print number_format($Total,2);?></td>
                  </tr>
                  <tr bgcolor="#C6C6CD"  >
                    <td colspan="4" align="right">Delivery Total</td>
                    <td>AU$<span id="Delivery"><?php print number_format($DTotalN,2); ?></span></td>
                  </tr>
                  <tr bgcolor="#C6C6CD"  id="GSTRow">
                    <td colspan="4" align="right"><input name="Total" type="hidden" id="Total" value="<?php print $Total; ?>">                      <input name="DN" type="hidden" id="DN" value="<?php print $DTotalN; ?>">
                      <input name="DI" type="hidden" id="DI" value="<?php print $DTotalI; ?>">
                      GST </td>
                    <td>AU$<?php print number_format(($Total+$DTotalN)/10,2);?> </td>
                  </tr>
                  <tr bgcolor="#C6C6CD"  >
                    <td colspan="4" align="right">Final Total </td>
                    <td>AU$<span id="FinalTotal"><?php print number_format(($Total+$DTotalN)*1.1,2);?></span> </td>
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
          
          
            </table></td>
    </tr>
  
</table>
