
              <form name="form1" method="post" action="/shopping-cart/">
                <table border="0" cellpadding="3" cellspacing="1" id="ProductRow">
                  
                  <tr bgcolor="#C6C6CD" >
                    <td>&nbsp;</td>
                    <td><strong>Name</strong></td>
                    <td><strong>Description</strong></td>
                    <td><strong>Price</strong></td>
                    <td><strong>Amount</strong></td>
                  </tr>
				  <?
					$Count=0;
					$sql="SELECT id,Image,Name,SDesc,Price,ProductCode FROM Products";
					
					    
					    $rslt=$r->RawQuery($sql);
                		while($myrow=$r->Fetch_Array($rslt)){
				?>
                  <tr bgcolor="<?=(($Count%2)==0 ? "#CECECE" : "#E5E5E5"); ?>" >
                    <td width="16%"><?
				  	if($myrow[1]!=""){
						?>
                        <img src="../ProductImages/<?=$myrow[1]?>">
                        <?
					}
				  ?></td>
                    <td width="36%"><?php print $myrow[2]; ?></td>
                    <td width="33%"><?php print $myrow[3]; ?></td>
                    <td width="6%">AU$<?php print $myrow[4]; ?></td>
                    <td width="9%" align="center"><input name="Products[<?php print $myrow[5]; ?>]" type="text" id="Products[<?php print $myrow[0]; ?>]" size="4"></td>
                  </tr>
				  <?
					};
				?>
                  <tr bgcolor="#405175"  >
                    <td colspan="5"><div align="right">
                      <input type="submit" name="Submit" value="Order">
                    </div></td>
                  </tr>
                </table>
              </form>
              
              