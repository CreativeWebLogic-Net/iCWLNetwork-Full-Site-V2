<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><form action="index.php"  method="post" enctype="multipart/form-data" name="form2" onSubmit="YY_checkform('form2','FirstName','#q','0','You must fill in the field Name.','Email','S','2','You must fill in a valid Email Address.','UserName','#q','0','You must fill in the field Username.','Password','#q','0','You must fill in the field Password','Password2','#Password','6','Passwords must match.');return document.MM_returnValue" >
              <span class="pageheading">Add New News Item</span><span class="RedText"><?php print $Message; ?></span><br>
              <br>
            Complete the news items details below.<br>
            <br>
            <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" id="table">
              <tr>
                <td class="tabletitle"><strong>News For Members Or The Public</strong></td>
                <td class="tablewhite"><select name="NType" id="NType">
                  <option value="Public">Public</option>
                  <option value="Member">Member</option>
                </select></td>
              </tr>
              <tr>
                <td class="tabletitle"><strong>News Title<span class="RedText">*</span></strong></td>
                <td class="tablewhite"><input name="Title" type="text" id="Title" value="Example News Item Title" size="45" onClick="ClearText(this)"></td>
              </tr>
              <tr>
                <td class="tabletitle"><strong>News Description</strong></td>
                <td class="tablewhite"><input name="description" type="text" id="description" value="" size="50" maxlength="150"></td>
              </tr>
              <tr>
                <td colspan="2" class="tabletitle"><a href="javascript:ShowHide(1);"><span id="ShowHidePageText">Show Page Options</span></a></td>
                </tr>
              <tr id="SHPRow0" style="display:none">
                <td width="163" class="tabletitle"><strong>Template</strong></td>
                <td width="352" class="tablewhite"><select name="templatesID" id="templatesID">
                  <?php
						
				$sql="SELECT id,Name FROM templates WHERE Hidden='No' ORDER BY Name";
        //$sql="SELECT id,Name FROM templates ORDER BY Name";
        //print $sql;
				$rslt=$r->rawQuery($sql);
				while($data=$r->Fetch_Array($rslt)){
					$tmp=($data[0]==$DInsert['templatesID'] ? "selected" : "");
					echo"<option value='$data[0]' $tmp>$data[1]</option>";
				};
        
			?>
                </select></td>
              </tr>
              <tr id="SHPRow1" style="display:none">
                <td class="tabletitle"><strong>Page Address<span class="RedText">*</span></strong></td>
                <td class="tablewhite"><input name="URI" type="text" id="URI" value="/news-item/example-page-address/" size="45" onClick="ClearText(this)"></td>
              </tr>
              <tr>
                <td colspan="2" class="tabletitle"><a href="javascript:ShowHide(0);"><span id="ShowHideText">Show Search Engine Options</span></a></td>
                </tr>
              <tr id="SHRow0" style="display:none">
                <td class="tabletitle"><strong>Meta Title</strong></td>
                <td class="tablewhite"><input name="Meta_Title" type="text" id="MenuTitle4" size="45"></td>
              </tr>
              <tr id="SHRow1" style="display:none">
                <td class="tabletitle"><strong>Meta Keywords</strong></td>
                <td class="tablewhite"><input name="Meta_Keywords" type="text" id="Meta_Keywords" size="45"></td>
              </tr>
              <tr id="SHRow2" style="display:none">
                <td class="tabletitle"><strong>Meta Description</strong></td>
                <td class="tablewhite"><input name="Meta_Description" type="text" id="MenuTitle3" size="45"></td>
              </tr>
              <tr>
                <td colspan="2" class="tabletitle"><strong>Content<span class="RedText">*</span></strong></td>
              </tr>
              <tr>
                <td colspan="2" align="center" class="tablewhite"><textarea name="content_text" cols="120" rows="20" id="content_text"></textarea></td>
                </tr>
            </table>
            <p><br>
              <input name="Submit" type="submit"  class="formbuttons" id="Submit" value="Save" onClick="return confirmSubmit()">
              </p>
            </form></td>
        </tr>
      </table>