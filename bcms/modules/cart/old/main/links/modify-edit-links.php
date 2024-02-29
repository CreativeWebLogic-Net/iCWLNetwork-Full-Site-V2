<?php
	include("../../Admin_Start_Include.php");
	
	$r= new ReturnRecord();  // base object for returning data or raw queries
	
	if($_POST['Submit']){
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("Links");
		$m->AddID($_POST['id']);
		if($_FILES['Photo']['name']){
			$m->ResizeImage("Photo","../../../links/Photos/","250x250");
			
		};
		$m->DoStuff();
		$Message="Link Updated";
				
	};
	
	if($_GET['id']) $id=$_GET['id'];
	elseif ($_POST['id']) $id=$_POST['id'];
	
	
	$r->AddTable("Links");
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
          <td>
            <span class="leftside">
            <?php
			include("../../menu.php");  
		?>
          </span>          </td>
        </tr>
    </table></td>
    <td height="665" valign="top" class="rightbg">
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
          <td><form action="modify-edit-links.php"  method="post" enctype="multipart/form-data" name="form2" onSubmit="YY_checkform('form2','FirstName','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','UserName','#q','0','You must fill in the field Username.','Password','#q','0','You must fill in the field Password','Password2','#Password','6','Passwords must match.');return document.MM_returnValue" >
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><span class="pageheading">Modify Link </span><span class="RedText"><?php print $Message; ?></span></td>
                  <td width="20%" align="right"><a href="modify-links.php" class="buttonbacklist">Back To List </a></td>
                </tr>
              </table>
              <br>
              <br>
        Complete the link details below.<br>
        <br>
        <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
          <tr>
            <td><strong>Category</strong></td>
            <td><select name="LinkCategoriesID" id="LinkCategoriesID">
				<?php
					$r=new ReturnRecord();
					$sq2=$r->rawQuery("SELECT id,Name FROM LinkCategories");  
					while ($myrow = mysql_fetch_row($sq2)) {
						$Tmp=($Insert['LinkCategoriesID']==$myrow[0] ? "selected" : "");
						echo"<option value='$myrow[0]' $Tmp>$myrow[1]</option>";
					};
				?>
            </select></td>
          </tr>
          <tr>
            <td><strong>Name<span class="RedText">*</span></strong></td>
            <td><input name="Name" type="text" id="Name" value="<?php print $Insert['Name']; ?>" size="45"></td>
          </tr>
          <tr>
            <td><strong>Description</strong></td>
            <td><textarea name="Description" cols="45" rows="5" id="Description"><?php print $Insert['Description']; ?></textarea></td>
          </tr>
          <tr>
            <td><strong>Custom HTML</strong></td>
            <td><textarea name="Custom" cols="45" rows="5" id="Custom"><?php print $Insert['Custom']; ?></textarea>
              <br>
              Leave blank unless a required link back HTML code is required, if so then paste in the HTML code.</td>
          </tr>
          <tr>
            <td><strong>Url</strong></td>
            <td><input name="Url" type="text" id="Name3" value="<?php print $Insert['Url']; ?>" size="45"></td>
          </tr>
          <tr>
            <td><strong>Photo</strong></td>
            <td><input name="Photo" type="file" id="Photo"></td>
          </tr>
          <tr>
            <td width="163"><strong>Sort Order  </strong></td>
            <td width="352"><input name="SOrder" type="text" id="Name4" value="<?php print $Insert['SOrder']; ?>" size="4">
              This number is from the top (the lowest number) to the bottom (the highest number) in each category</td>
          </tr>
          <tr>
            <td height="25" colspan="2"><input name="Submit" type="submit"  class="formbuttons" id="Submit" value="Save" onClick="return confirmSubmit()">
              <input name="id" type="hidden" id="id" value="<?php print $id; ?>"></td>
          </tr>
        </table>
          </form></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
