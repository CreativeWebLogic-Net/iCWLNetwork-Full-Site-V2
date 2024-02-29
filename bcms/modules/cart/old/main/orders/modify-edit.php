<?php
	include("../../Admin_Start_Include.php");
	
	
	$r= new ReturnRecord();  // base object for returning data or raw queries
	
	
	if($_POST['Submit']){
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("Administrators");
		$m->AddID($_POST['id']);
		$m->DoStuff();
		$Message="Administrator Updated";
		
		$d= new DeleteFromDatabase();
		$d->AddIDArray(array($_POST['id']));
		$d->AddTable("AGroups_Links");
		$d->AltDeleteVar("AdministratorsID");
		$Errors=$d->DoDelete();
		if($Errors==""){
			/*
			if(is_array($_POST['Perms'])){
				foreach($_POST['Perms'] as $PermID){
					$result=$r->rawQuery("INSERT INTO AGroups_Links (AdministratorsID,AGroupsID) VALUES ('$_POST[id]','$PermID')"); 
					if(!result) $Message.=" error adding permission groups";
				};
			};
			*/
		}else{
			$Message.=$Errors;
		};
		
		
	};
	
	if($_GET['id']) $id=$_GET['id'];
	elseif ($_POST['id']) $id=$_POST['id'];
	
	
	
	
	$r->AddTable("OrderDetails");
	$r->AddSearchVar($id);
	$Insert=$r->GetRecord();
	

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
    <td height="642" valign="top" class="rightbg">
	
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
          <td><form action="modify-edit.php"  method="post" name="form2" onSubmit="YY_checkform('form2','FirstName','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','UserName','#q','0','You must fill in the field Username.','Password','#q','0','You must fill in the field Password','Password2','#Password','6','Passwords must match.');return document.MM_returnValue">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><span class="pageheading">View Order Details </span><span class="RedText"><?php print $Message; ?></span></td>
                  <td width="20%" align="right"><a href="modify.php" class="buttonbacklist">Back To List </a></td>
                </tr>
              </table>
              <br>
        Complete the administrator details below.<br>
        <br>
        <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
          <tr>
            <td width="163"><strong> First Name</strong></td>
            <td width="352"><?=$Insert['FName']; ?></td>
          </tr>
          <tr>
            <td><strong>Last Name </strong></td>
            <td><?=$Insert['LName']; ?></td>
          </tr>
          <tr>
            <td><strong> Email</strong></td>
            <td><?=$Insert['Email']; ?></td>
          </tr>
          <tr>
            <td><strong>Company Name </strong></td>
            <td><?=$Insert['CompanyName']; ?></td>
          </tr>
          <tr>
            <td><strong>Phone</strong></td>
            <td><?=$Insert['Phone']; ?></td>
          </tr>
          <tr>
            <td><strong> Street Address</strong></td>
            <td><?=$Insert['StreetAddress']; ?></td>
          </tr>
          <tr>
            <td><strong> Suburb</strong></td>
            <td><?=$Insert['Suburb']; ?></td>
          </tr>
          <tr>
            <td><strong>City</strong></td>
            <td><?=$Insert['City']; ?></td>
          </tr>
          <tr>
            <td><strong>State</strong></td>
            <td><?=$Insert['State']; ?></td>
          </tr>
          <tr>
            <td><strong>Post/Zipcode</strong></td>
            <td><?=$Insert['Postcode']; ?></td>
          </tr>
          <tr>
            <td><strong>Country </strong></td>
            <td><?
			$sql=$r->rawQuery("SELECT name FROM country WHERE id='$Insert[Country]'");
			$myrow=mysql_fetch_row($sql);
			print $myrow[0];
			
			?></td>
          </tr>
          <tr>
            <td><strong>Order Successful </strong></td>
            <td><?=$Insert['Success']; ?></td>
          </tr>
          
          <tr>
            <td height="25" colspan="2">              <input name="id" type="hidden" id="id" value="<?php print $id; ?>"></td>
          </tr>
        </table>
          </form></td>
        </tr>
      </table>
      <br>
      Order For :- <br>
      <table width="93%"  border="0" align="center" cellpadding="3" cellspacing="1" id="ProductRow">
        <tr bgcolor="#C6C6CD" >
          <td width="21%"><strong>Name</strong></td>
          <td><strong>Description</strong></td>
          <td><strong>Product Code </strong></td>
          <td><strong>Price</strong></td>
          <td><strong>Amount</strong></td>
          <td width="9%"><strong>Sub Total </strong></td>
        </tr>
        <?
					$Count=0;
					$Total=0;
					
					$r=new ReturnRecord();
					$sq2=$r->rawQuery("SELECT id,Name,SDesc,Price,Delivery,Amount,ProductCode FROM ProductOrders WHERE OrderDetailsID='$id'");  
					while ($myrow = mysql_fetch_row($sq2)) {
						$Count++;
						$STotal+=$myrow[3]*$myrow[5];
						$DTotal+=$myrow[4];
						$Total+=($myrow[3]*$myrow[5])+$myrow[4];
						if($Insert['Country']==1)
							$GST+=(($myrow[3]*$myrow[5])+$myrow[4])/10;
						?>
        <tr bgcolor="<?=(($Count%2)==0 ? "#CECECE" : "#E5E5E5"); ?>" >
          <td><?=$myrow[1]?></td>
          <td width="34%"><?=$myrow[2]?></td>
          <td width="20%"><?=$myrow[6]?></td>
          <td width="7%" align="left">$<?=number_format($myrow[3],2)?></td>
          <td width="9%" align="left"><?=$myrow[5]?></td>
          <td align="center"><?=number_format($myrow[5]*$myrow[3],2)?></td>
        </tr>
        <?
							
					};
				?>
        <tr bgcolor="#C6C6CD"  >
          <td colspan="5" align="right">Total</td>
          <td>$<?=number_format($STotal,2)?></td>
        </tr>
        <tr bgcolor="#C6C6CD"  id="GSTRow">
          <td colspan="5" align="right">Delivery Total</td>
          <td>$<?=$DTotal?></td>
        </tr>
        <tr bgcolor="#C6C6CD"  >
          <td colspan="5" align="right">GST</td>
          <td>$<?=number_format($GST,2)?></td>
        </tr>
        <tr bgcolor="#C6C6CD"  >
          <td colspan="5" align="right">Final Total </td>
          <td>$<?=number_format($STotal+$DTotal+$GST,2)?></td>
        </tr>
        <tr bgcolor="#405175"  >
          <td colspan="6"><div align="right">
          </div></td>
        </tr>
      </table>
    <div align="center"></div></td>
  </tr>
</table>
</body>
</html>
