<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><form action="modify.php"  method="get" name="form2" >
              <p><span class="pageheading">Modify / Delete Members </span><span class="RedText"><?php print $Message; ?></span></p>
              <table border="0" align="center" cellpadding="2" cellspacing="1"  id="table">
                <tr>
                  <td align="right" class="tabletitle">Keywords : </td>
                  <td width="150"><input name="SText" type="text" class="formFields" id="SText" value="<?php print $SText;?>" size="30"></td>
                  <td align="right" class="tabletitle">Search By :</td>
                  <td width="116" class="tabletitle"><select name="SType" class="formFields" id="SType">
                    <option value="id" <?php print($SType=="id" ? "selected" :"");?>>User ID</option>
                    <option value="name" <?php print($SType=="name" ? "selected" :"");?>>Name</option>
                    <option value="email" <?php print($SType=="email" ? "selected" :"");?>>Email</option>
                    <option value="address" <?php print($SType=="address" ? "selected" :"");?>>Address</option>
                    <option value="suburb" <?php print($SType=="suburb" ? "selected" :"");?>>Suburb</option>
                    <option value="state" <?php print($SType=="state" ? "selected" :"");?>>State</option>
                    <option value="postcode" <?php print($SType=="postcode" ? "selected" :"");?>>Postcode</option>
                    
                    <option value="phone" <?php print($SType=="phone" ? "selected" :"");?>>Phone</option>
                    <option value="mobile" <?php print($SType=="mobile" ? "selected" :"");?>>Mobile</option>
                    <option value="website" <?php print($SType=="website" ? "selected" :"");?>>Website</option>
                    <option value="contact_name" <?php print($SType=="contact_name" ? "selected" :"");?>>Contact Name</option>
                    <option value="abn" <?php print($SType=="abn" ? "selected" :"");?>>ABN</option>
                  </select></td>
                  <td width="75" colspan="4" rowspan="2" align="center" class="tabletitle"><input name="Search" type="submit" class="formButtons" value="Search"></td>
                </tr>
                <tr>
                  <td width="81" align="right" class="tabletitle">Sort By : </td>
                  <td align="center" class="tabletitle">
                    <select name="OType" id="OType">
                      <option value="id" <?php print($OType=="id" ? "selected" :"");?>>User ID</option>
                      <option value="name" <?php print($OType=="name" ? "selected" :"");?>>Name</option>
                      <option value="email" <?php print($OType=="email" ? "selected" :"");?>>Email</option>
                      <option value="status" <?php print($OType=="status" ? "selected" :"");?>>Status</option>
                    </select>
                  </td>
                  <td width="130" align="center" class="tabletitle">
                    <select name="OOType" id="OOType">
                      <option value="ASC" <?php print($OOType=="ASC" ? "selected" :"");?>>Ascending</option>
                      <option value="DESC" <?php print($OOType=="DESC" ? "selected" :"");?>>Descending</option>
                    </select>
                  </td>
                  <td align="center" class="tabletitle"><select name="NumRows" class="formFields" id="NumRows">
                    <option value="10">10 Rows</option>
                    <option value="20">20 Rows</option>
                    <option value="40">40 Rows</option>
                    <option value="80">80 Rows</option>
                    <option value="160">160 Rows</option>
                  </select></td>
                </tr>
              </table>
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="1" id="table"  >
                <tr bgcolor="#363E57" id="tablecell">
                  <td width="13%" class="tabletitle"> ID</td>
                  <td width="34%" class="tabletitle">Name</td>
                  <td bgcolor="#363E57" class="tabletitle"><?php ucwords(str_replace("_"," ",$DynField));?></td>
                  <td width="4%" align="center" bgcolor="#363E57" class="tabletitle">Status</td>
                  <td width="9%" align="center" class="tabletitle">Modify</td>
                  <td width="9%" align="center" class="tabletitle">Select</td>
                </tr>
                <?php
					$Count=0;
          //echo "=>$rcount<=";
          $rset=$r->rawQuery($SQL_table);
          $rcount=$r->NumRows();
					if($rcount>0){
						while ($myrow = $r->Fetch_Array()) {
              //echo "$myrow[0]<=";
				?>
                <tr class="<?php print(($Count%2)==0 ? "row1" : "row2"); ?>">
                  <td><?php print $myrow[0];?></td>
                  <td><?php print $myrow[1];?></td>
                  <td><?php print $myrow[2];?></td>
                  <td align="center"><?php print $myrow[3];?></td>
                  <td align="center"><a href="modify-edit.php?id=<?php print $myrow[0];?>"><img src="../../images/modify.gif" width="47" height="16" border="0"></a></td>
                  <td><div align="center">
                      <input type="checkbox" name="DFiles[]" value="<?php print $myrow[0];?>">
                  </div></td>
                </tr>
                <?php
							$Count++;
						};
					};
					?>
                <tr align="right" bgcolor="#B2C8D8">
                  <td colspan="5" align="left" bgcolor="#B2C8D8"><p>
                    <?php print($StartRecord+1);?>
                    -
  <?php print $RecTo;?>
                    of
  <?php print $rcount;?>
                    Results</p>
                    <p>
                      <?php if($Page>1){ ?>
                      <a href="modify.php?Page=<?php print $Page-1;?>&<?php print $NPPage?>" >&lt;&lt;Back</a> 
                      <?php }; ?>
                      <?php
		for($x=1;$x<=$MaxPages;$x++){
			?><a href="modify.php?Page=<?php print $x;?>&<?php print $NPPage?>" ><?php print $x?></a> <?php
		};
	  ?>
                      <?php
						if($Page<$MaxPages){
					?>
                       <a href="modify.php?Page=<?php print $Page+1;?>&<?php print $NPPage?>" >Next &gt;&gt; </a>
                      <?php
						};
					?>
                  </p></td>
                  <td align="center"><input name="Delete" type="submit" class="formbuttons" id="Delete" value="Disable" onClick="return confirmSubmit()">
                  <input name="Delete" type="submit" class="formbuttons" id="Delete" value="Enable" onClick="return confirmSubmit()"></td>
                </tr>
              </table>
            <strong><br>
              To Delete an Administrator:</strong> select the checkbox for that Administrator and then choose Delete button. <br>
            <strong>Tip:</strong> You can select multiple Administrators. <br>
          </form></td>
        </tr>
    </table>