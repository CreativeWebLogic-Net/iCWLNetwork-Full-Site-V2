<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><form action="modify.php"  method="post" name="form2" >
              <span class="pageheading">Modify / Delete News Items / Promotions </span><span class="RedText"><?php print $Message; ?></span><br>
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="table">
                <tr bgcolor="#363E57" id="tablecell">
                  <td width="28%" class="tabletitle"> Page Address</td>
                  <td width="5%" class="tabletitle">Title</td>
                  <td width="15%" class="tabletitle">Type</td>
                  <td width="15%" class="tabletitle">Public / Member</td>
                  <td width="9%" class="tabletitle">Approved</td>
                  <td width="11%" class="tabletitle">MembersID</td>
                  <td width="8%" align="center" class="tabletitle">Modify</td>
                  <td width="9%" align="center" class="tabletitle">Delete</td>
                </tr>
                <?php
					  	$Count=0;
					 	//$r=new ReturnRecord();
						$sql="SELECT content_pages.id,URI,content_pages.Title,NType,usersID,Approved,MNType ";
            $sql.="FROM content_pages,mod_news WHERE content_pages.id=mod_news.content_pagesID AND ";
            $sql.="domainsID=".$session_data['domainsID']." AND languagesID=".$session_data['languagesID'];
            $sql.=" AND module_viewsID=332 ORDER BY SOrder";
						//print $sql;
						$sq2=$r->rawQuery($sql);  
						while ($myrow = $r->Fetch_Array($sq2)) {
						?>
                <tr class="<?php print(($Count%2)==0 ? "row1" : "row2"); ?>">
                  <td><?php print $myrow[1];?></td>
                  <td><?php print $myrow[2];?></td>
                  <td><a href="../members/modify-edit.php?id=<?php print $myrow[0];?>">
                    <?php print $myrow[6];?>
                  </a></td>
                  <td><?php print $myrow[3];?></td>
                  <td><a href="../members/modify-edit.php?id=<?php print $myrow[0];?>">
                    <?php print $myrow[5];?>
                  </a></td>
                  <td><a href="../members/modify-edit.php?id=<?php print $myrow[4];?>"><?php print $myrow[4];?></a></td>
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
                  <td colspan="7"><input name="Approve" type="submit" class="formbuttons" id="Approve" value="Approve" onClick="return confirmSubmit()"></td>
                  <td align="center"><input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()">                  </td>
                </tr>
              </table>
            <strong><br>
              To Delete a News Item:</strong> select the checkbox for that News Item and then choose Delete button. <br>
            <strong>Tip:</strong> You can select multiple News Items. <br>
          </form></td>
        </tr>
      </table>