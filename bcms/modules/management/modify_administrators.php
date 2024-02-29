<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><form action="modify.php"  method="post" name="form2" >
              <span class="pageheading">Modify / Delete Administrator </span><span class="RedText"><?php print $Message; ?></span><br>
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="table">
                <tr bgcolor="#363E57" id="tablecell">
                  <td class="tabletitle"> Username</td>
                  <td class="tabletitle">Name</td>
                  <td bgcolor="#363E57" class="tabletitle">Email</td>
                  <td width="1%" align="center" class="tabletitle">Modify</td>
                  <td width="1%" align="center" class="tabletitle">Delete</td>
                </tr>
                <?php
					  	$Count=0;
						if($session_data["SU"]!="No"){
							$sql="SELECT id,username,name,email FROM administrators  WHERE clientsID=$session_data[clientsID] ";
						}else{
							$sql="SELECT id,username,name,email FROM administrators  WHERE clientsID=$session_data[clientsID] AND id=$session_data[administratorsID]";
						}
					 	
						$sq2=$r->rawQuery($sql);  
						while ($myrow = $r->Fetch_Array($sq2)) {
						?>
                <tr class="<?php print(($Count%2)==0 ? "row1" : "row2"); ?>">
                  <td><?php print $myrow[1];?></td>
                  <td><?php print $myrow[2];?></td>
                  <td><?php print $myrow[3];?></td>
                  <td align="center"><a href="modify-edit.php?id=<?php print $myrow[0];?>"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                  <td><div align="center">
                      <input type="checkbox" name="DFiles[]" value="<?php print $myrow[0];?>">
                  </div></td>
                </tr>
                <?php
							$Count++;
						};
					?>
                <tr align="right" bgcolor="#B2C8D8">
                  <td colspan="4">&nbsp;</td>
                  <td align="center"><input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">                  </td>
                </tr>
              </table>
            <strong><br>
              To Delete an Administrator:</strong> select the checkbox for that Administrator and then choose Delete button. <br>
            <strong>Tip:</strong> You can select multiple Administrators. <br>
          </form></td>
        </tr>
      </table>