<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><form action="modify-edit.php"  method="post" name="form2" onSubmit="YY_checkform('form2','FirstName','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','UserName','#q','0','You must fill in the field Username.','Password','#q','0','You must fill in the field Password','Password2','#Password','6','Passwords must match.');return document.MM_returnValue">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><span class="pageheading">Modify Administrator </span><span class="RedText"><?php print $Message; ?></span></td>
                  <td width="20%" align="right"><a href="modify.php" class="buttonbacklist">Back To List </a></td>
                </tr>
              </table>
            <br>
            Complete the administrator details below.<br>
            <br>
            <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" id="tablecell">
              <tr>
                <td width="232"><strong> Name<span class="RedText">*</span></strong></td>
                <td width="403"><input name="name" type="text" class="formfield1" id="name" value="<?php print $Insert['name']; ?>"></td>
              </tr>
              <tr>
                <td><strong> Email<span class="RedText">*</span></strong></td>
                <td><input name="email" type="text" class="formfield1" id="email" value="<?php print $Insert['email']; ?>"></td>
              </tr>
              <tr>
                <td><strong> Username<span class="RedText">*</span></strong></td>
                <td><input name="username" type="text" class="formfield1" id="username" value="<?php print $Insert['username']; ?>"></td>
              </tr>
              <tr>
                <td><strong> Password<span class="RedText">*</span></strong></td>
                <td><input name="password" type="password" class="formfield1" id="password" value="<?php print $Insert['password']; ?>"></td>
              </tr>
              <tr>
                <td><strong> Retype Password Again<span class="RedText">*</span> </strong></td>
                <td><input name="password2" type="password" class="formfield1" id="password2" value="<?php print $Insert['password']; ?>"></td>
              </tr>
              <tr>
                <td height="25"><strong>Website Available To Administrator</strong></td>
                <td height="25"><select name="domainsID[]" size="5" multiple id="domainsID[]">
                <?php
                
                  if(isset($session_data["SU"])){
                    if($session_data["SU"]!="No"){
                      $sql="SELECT domains.id,Name FROM domains WHERE  clientsID=$session_data[clientsID] ORDER BY Name";
                    }else{
                      $sql="SELECT domains.id,Name FROM domains,administrators_domains WHERE domains.id=administrators_domains.domainsID AND administratorsID=$session_data[administratorsID] AND  clientsID=$session_data[clientsID] ORDER BY Name";
                    }
                    //print $sql;
                    $rslt=$r->rawQuery($sql);
                    while($data=$r->Fetch_Array($rslt)){
                      //print_r($data);
                      $tmp=(in_array($data[0],$DomArr) ? "selected" : "");
                      echo"<option value='$data[0]' $tmp>$data[1]</option>";
                    };
                  
                  };
                  
				        ?>
                </select></td>
              </tr>
            </table>
            <input name="Button2" type="button" class="formbuttons" onClick="MM_goToURL('parent','modify.php');return document.MM_returnValue;return confirmSubmit()" value="Cancel">
            <input name="Submit" type="submit"  class="formbuttons" id="Submit3" value="Save" onClick="return confirmSubmit()">
            <input name="id" type="hidden" id="id" value="<?php print $id; ?>">
          </form></td>
        </tr>
      </table>