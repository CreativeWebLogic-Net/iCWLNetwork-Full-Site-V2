<?
		
	if(($_POST['Submit'])&&(is_array($_SESSION['Products']))){
		$r->AddTable("Preferences");
		$r->AddSearchVar(1);
		$Insert=$r->GetRecord();
		
		$_POST['Discount']=$MDiscount;
		$_POST['ClientsID']=CLIENTSID;
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("OrderDetails");
		$m->DoStuff();
		$NewID=$m->ReturnID();
		
		$Items="";						
		$DeliveryTotal=0;
		$GoodsTotal=0;
		$Total=0;
		if(is_array($_SESSION['Products'])){
			foreach($_SESSION['Products'] as $key=>$val){
				$r=new ReturnRecord();
				$sq2=$r->rawQuery("SELECT id,Image,Name,SDesc,Price,WPrice,Weight,ProductCode,SuppliersID FROM Products WHERE id='$val[id]'");  
				while ($myrow = mysql_fetch_row($sq2)) {
					if($MPerms->IsWholesale()) $myrow[4]=$myrow[5];
					if($Insert['Country']==$_POST['Country']){
						$Delivery=$myrow[5];
					}else{
						$Delivery=$myrow[6];
					}
					
					$GoodsTotal+=$val['amount']*$myrow[4];
					$Total+=$Delivery+($val['amount']*$myrow[4]);
					$GSTTotal+=($Delivery+($val['amount']*$myrow[4]))*0.1;
					
					
					
					$EmailBody.="<tr>
									<td>$myrow[2]";
					$Items.="$myrow[2]/";
					
					$r->rawQuery("INSERT INTO ProductOrders (OrderDetailsID,Name,SDesc,Price,Delivery,Amount,ProductCode,SuppliersID,WPrice) 
					VALUES ('$NewID','$myrow[2]','$myrow[3]','$myrow[4]','$Delivery','$val[amount]','$myrow[7]','$myrow[8]','$myrow[9]')");
					$NPID=mysql_insert_id();
					
					foreach($val['Options'] as $OKey=>$OptionArray){
						$sq7=$r->rawQuery("SELECT Question FROM ProductOptions WHERE id='$OptionArray[ProductOptionsID]'");  
						$myrow7 = mysql_fetch_array($sq7);
						$sq7=$r->rawQuery("SELECT Adjustment FROM ProductOptionLinks WHERE ProductOptionsID='$OptionArray[ProductOptionsID]' AND ProductsID='$val[id]'");  
						$myrow8 = mysql_fetch_array($sq7);
						if($myrow8[0]>0){
							$Total+=$myrow8[0]*$val['amount'];
							
						}else{
							$sq7=$r->rawQuery("SELECT Adjustment FROM ProductDropDown WHERE ProductOptionsID='$OptionArray[ProductOptionsID]' AND DropDownValue='$OptionArray[Value]' AND ProductsID='$val[id]'");  
							$myrow8 = mysql_fetch_array($sq7);
							if($myrow7[0]>0){
								$Total+=$myrow8[0]*$val['amount'];
							};
						}
						
						$r->rawQuery("INSERT INTO ProductOptionValues (ProductOrdersID,Question,Value,Adjustment) 
					VALUES ('$NPID','$myrow7[0]','$OptionArray[Value]','$myrow8[0]')");
					};
				};
			
			};
			
		};
		
		if(1==$_POST['Country']) $Total*=1.1; // Add GST
		
			
		
		unset($_SESSION['Products']);
		$_SESSION['Invoice']=$NewID;
		$_SESSION['PaymentGatewaysID']=$_POST['PaymentGatewaysID'];
		$DeliveryTotal=$_POST['Delivery'];
		$Total=number_format($Total-(($MDiscount/100)*$Total),2);
	};
?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frmBuy" id="frmBuy" onsubmit="return ExternalPost()">
                
                <input name="cmd" type="hidden" id="cmd" value="_xclick">
                <input name="amount" type="hidden" id="amount" value="<?=$GoodsTotal?>">
				<input name="currency_code" type="hidden" id="currency_code" value="AUD">
				<input name="handling" type="hidden" id="handling" value="<?=$DeliveryTotal?>">
                <input name="notify_url" type="hidden" id="notify_url" value="http://<?=$_SERVER['HTTP_HOST']?>/main/modules/ShoppingCart/PG_PayPal_Background.php">
				<input name="item_name" type="hidden" id="amount" value="<?=$Items?>">
                <input name="item_number" type="hidden" id="item_number" value="<?=$NewID?>">
				<input name="return" type="hidden" value="http://<?=$_SERVER['HTTP_HOST']?>/site/success/success/">
                <br>
                <input name="business" type="hidden" id="business" value="<?=$Insert['MerchantID']?>">
                <input type="submit" name="Submit" value="Click To Enter Payment Gateway">
                <br>
</form>
<script>
document.frmBuy.submit();
</script>