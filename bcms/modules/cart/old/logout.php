<?
	session_start();
	session_destroy();
	
	$Message="You are logged out";
	


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>DAlc.info Shopping Cart Administration</title>
<link href="css/management.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="form1" method="post" action="index.php">
      <table  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center"><img src="images/logo.gif" width="179" height="75" vspace="5"></td>
        </tr>
        <tr>
          <td><img src="images/login-top.gif" width="400" height="24"></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#363E57"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td>
				<span class="RedText"><?php print $Message; ?></span>
				<table  border="0" align="center" cellpadding="0" cellspacing="6">
                    <tr>
                      <td width="170" height="20" align="right" bgcolor="#5E6579" class="loginwhite"><strong>Username:</strong> &nbsp; </td>
                      <td><input name="UserName" type="text" class="loginfield" id="UserName"></td>
                    </tr>
                    <tr>
                      <td  width="170" height="20" align="right" bgcolor="#5E6579" class="loginwhite"><strong>Password:</strong> &nbsp; </td>
                      <td><input name="Password" type="password" class="loginfield" id="Password"></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td><input name="Submit" type="submit" class="loginbutton" value="Login"></td>
                    </tr>
                    <tr align="center">
                      <td height="20" colspan="2"><a href="#" class="login">Have you forgotten your password? Click here</a></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="10" bgcolor="#F2960D"></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
