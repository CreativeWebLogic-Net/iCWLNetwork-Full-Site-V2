<?php
		
		
		if(isset($session_data["administratorsID"])){
			
	?>
  <!--
	We are redireting you into managment, <a href="main/logged-in/index.php">Click Here</a> To Manually Forward.
			<script>
			location.href = "main/logged-in/index.php";
			</script>
    -->
	<?php
			
		}else{
	?>	
	<form name="form1" method="post" action="">
			

      <table  border="1" align="center" cellpadding="0" cellspacing="0">
       
        <tr>
          <td align="center" ><table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><table  border="0" align="center" cellpadding="0" cellspacing="6" class="ManagementLoginBox">
				<tr>
                      <td height="20" colspan="2" align="center" ><span class="blacktextbold">Welcome to Creative Web Logic's Website Builder</span></td>
                      </tr>
                  <tr>
                      <td height="20" colspan="2" align="center" ><span class="RedText"><?php print $Message; ?></span></td>
                      </tr>
                    <tr>
                      <td width="130" height="20" align="right" ><span class="blacktextbold"><strong>Username:</strong> &nbsp;</span> </td>
                      <td width="212"><input name="UserName" type="text" class="loginfield" id="UserName"></td>
                    </tr>
                    <tr>
                      <td  width="130" height="20" align="right"><span class="blacktextbold"><strong>Password:</strong> &nbsp;</span> </td>
                      <td><input name="Password" type="password" class="loginfield" id="Password"></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center">
					  <input name="Login_Code" type="hidden" value="123456789"> 	
					  <input name="Submit" type="submit" class="loginbutton" value="Login"> <a href="register.php">Register</a>
					</td>
                      </tr>
                    
                </table>
				
				</td>
              </tr>
          </table></td>
		  <td>
		  
		  </td>
        </tr>
        
        
      </table>
      
      </form>
		  
<?php
		}
	  ?>