<?php
	include("../../Admin_Start_Include.php");
	
	$r= new ReturnRecord();  // base object for returning data or raw queries
	
	if($_GET['id']) $id=$_GET['id'];
	if($_POST['id']) $id=$_POST['id'];

if($_POST['Submit']){
	$sql="UPDATE Content_Pages SET URI='".mysql_escape_string($_POST['URI'])."',Title='".mysql_escape_string($_POST['Title'])."',MenuTitle='".mysql_escape_string($_POST['MenuTitle'])."',Content='".mysql_escape_string($_POST['Content'])."',languagesid=1,Changed=NOW() WHERE id=$id"   ;
 	$result=$r->RawQuery($sql);
	if(!$result) print mysql_error()."<br>".$sql;
	echo"Page Updated";
}

$sql="SELECT * FROM Content_Pages WHERE id=$id";
$result=$r->RawQuery($sql);
//print $sql;
$data=mysql_fetch_assoc($result);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>DAlc.info Shopping Cart Administration</title>
<link href="../../css/management.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_mce_src.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,searchreplace,paste,directionality,noneditable,contextmenu,iespell",
		theme_advanced_buttons1_add_before : "",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,forecolor,backcolor,search,replace",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "advhr,separator,ltr,rtl,iespell",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		content_css : "/retailer-find-designer/css/style.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;"
	});
	
	var FileWindow;
	
	function fileBrowserCallBack(field_name, url, type, win) {
		FileWindow=win;
		// This is where you insert your custom filebrowser logic
		//alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);
		window.open('/admin/main/assets/assets.php?field_name='+ field_name +"&type=" + type,'Assets','width=650,height=600');
		// Insert new URL, this would normaly be done in a popup
		//win.document.forms[0].elements[field_name].value ="" ;
	}
	function CallBackReturn(field_name, url){
		FileWindow.document.forms[0].elements[field_name].value =url ;
	}
</script>
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
          <td><form action="modify-content.php"  method="post" name="form2" onSubmit="YY_checkform('form2','FirstName','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','UserName','#q','0','You must fill in the field Username.','Password','#q','0','You must fill in the field Password','Password2','#Password','6','Passwords must match.');return document.MM_returnValue" >
              <span class="pageheading">Modify Content  </span><span class="RedText"><?php print $Message; ?></span><br>
              <br>
        Complete the details below.<br>
        <br>
        <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
        <table width="83%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="59%">Page Path e.g. (/iwebbiz/webdesign/) </td>
            <td width="41%"><input name="URI" type="text" id="URI" value="<?=$data['URI'];?>" size="50" /></td>
          </tr>
          <tr>
            <td>Page Title </td>
            <td><input name="Title" type="text" id="Title" value="<?=$data['Title'];?>" size="50" /></td>
          </tr>
          <tr>
            <td>Menu Title </td>
            <td><input name="MenuTitle" type="text" id="MenuTitle" value="<?=$data['MenuTitle'];?>" size="50" /></td>
          </tr>
          <tr>
            <td colspan="2">Page Text Content </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><textarea name="Content" cols="80" rows="20" id="Content"><?=stripslashes(stripslashes(str_replace('\\n',"",str_replace('\\r',"",$data['Content']))));?>
          </textarea></td>
          </tr>
          <tr>
            <td><input name="id" type="hidden" id="id" value="<?=$id; ?>" /></td>
            <td><input type="submit" name="Submit" value="Submit" /></td>
          </tr>
        </table>
          </form></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
