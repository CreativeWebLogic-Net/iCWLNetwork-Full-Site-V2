<?php
//print_r($_POST);
    ////$_SESSION=array();
	if(isset($_POST['Submit'])){
	    if($_POST['Submit']=="Order"){
    		if(is_array($_POST)){
    		    if(!isset($_SESSION['Products'])){
    		        $_SESSION['Products']=array();
    		    }
    		    $item_count=0;
    		    
    			foreach($_POST as $ID=>$Amount){
    			    if(is_numeric($Amount)){
    			        if($Amount>0){
        			        //echo"<br> \n\n->".$ID."-".$Amount."<br>ggg \n\n";
            			    //set_log(array($ID,$Amount),"xxx321");
        				     
        				    if(!isset($_SESSION['Products'][$ID])){
        				        $_SESSION['Products'][$ID]=0;
        				    }
        				    if(is_array($_SESSION['Products'][$ID])){
        				        $_SESSION['Products'][$ID]=0;
        				    }
        					if($_SESSION['Products'][$ID]>0){
        					    if(!is_array($_SESSION['Products'][$ID])){
        						    $_SESSION['Products'][$ID]+=$Amount;
        						}
        					}else{
        						$_SESSION['Products'][$ID]=$Amount;
        					}
        					//print_r($_SESSION);
    			        }
    				}
    				$item_count++;
    		    }
    		    
		    }
		}
	}
	//echo"<pre>";
	//print_r($_POST);
	//print_r($_SESSION);
	if(isset($_POST['Submit'])){
    	if($_POST['Submit']=="Change"){
    		if(is_array($_POST)){
    			foreach($_POST as $ID=>$Amount){
    			    if($ID!=$_POST['Submit']){
    			        if($Amount==0){
        					unset($_SESSION['Products'][$ID]);
        				}else{
        					$_SESSION['Products'][$ID]=$Amount;
        				}
    			    }
    				
    			}
    		}
    		if(is_array($_POST)){
    			foreach($_POST as $ID=>$Amount){
    			    if($ID!='Submit'){
    			        $str=substr($Amount, 0, 7);  
    			        
    			        if($str=="delete_"){
    			            //echo "\n\n 111fff".$str."=>".$_SESSION['Products'][$ID]."\n\n"."\n\n"; 
    			            //$_SESSION['Products'][$ID]=0;
    			            unset($_SESSION['Products'][$ID]);
    			        }else{
    			           //echo "\n\n gggf".$str."\n\n"; 
    			        }
    				    
    			    }
    			}
    		}
    	}
	}
	//echo"</pre>";
	
?>

              <form name="form1" method="post" action="">
                <table width="589"  border="0" cellpadding="3" cellspacing="1" id="ProductRow">
                  
                  <tr bgcolor="#C6C6CD" >
                    <td width="144"><strong>Name</strong></td>
                    <td><strong>Description</strong></td>
                    <td><strong>Price</strong></td>
                    <td><strong>Amount</strong></td>
                    <td><strong>Delete</strong></td>
                  </tr>
				  <?php
					$Count=0;
					$Total=0;
					$cart_array=array();
					if(isset($_SESSION['Products'])){
    					if(is_array($_SESSION['Products'])){
    					    $product_array=$_SESSION['Products'];
    						    foreach($product_array as $key=>$val){
    						        if($val>0){
            						    $sql="SELECT id,Image,Name,SDesc,Price,ProductCode FROM Products WHERE ProductCode='$key'";
                    					$rslt=$r->RawQuery($sql);
                    					//print_r($sql);
                                    	while($myrow=$r->Fetch_Array($rslt)){
                                    	    
                                    	    if($myrow[5]==$key){
                                    	        //echo"\n\n yyy $key=>$val  \n\n";
                                    	        $sub_total=0;
                                    	        $sub_total=$val*$myrow[4];
                                    	        $Total+=$sub_total;
                                    	        $cart_array[$Count]=array(0=>$myrow,1=>$val,2=>$Count,3=>$key,4=>$sub_total,5=>$Total);
                                    	        $show=true;
                                    	    }else{
                                    	        $show=false;
                                    	    }
                                    	    
            							    if($show){
                							    $oa=$cart_array[$Count];
                							    //print_r($oa);
                							    ?>
                								  <tr bgcolor="<?php print (($oa[2]%2)==0 ? "#CECECE" : "#E5E5E5"); ?>" >
                									<td><?php print $oa[0][2]; ?></td>
                									<td width="275"><?php print $oa[0][3];?></td>
                									<td width="46">AU$<?php print $oa[0][4];?></td>
                									<td width="46" align="center"><input name="modify_Products[<?php print $oa[0][5];?>]" type="text" size="4" value="<?php print $oa[1];?>"></td>
                								    <td width="40" align="center"><input type="checkbox" name="Delete[<?php print $oa[0][5];?>]" value="delete_<?php print $oa[0][0];?>"></td>
                								  </tr>
                								  <?php
                								  $Count++;
            							    }
            							};
        						    }
    						    }
    						//};
    					};
					};
			    ?>
                                 <tr bgcolor="#C6C6CD"  >
                                    <td colspan="2" align="right">TOTAL</td>
                                    <td colspan="3">$<?php print $Total;?></td>
                                  </tr>
                    <tr bgcolor="#405175"  >
                    <td colspan="5"><div align="right">
                      <input type="submit" name="Submit" value="Change">
                      <br>
                      <br>
                      <input name="Button" type="button" onClick="MM_goToURL('parent','checkout.php');return document.MM_returnValue" value="Checkout">
                    </div></td>
                  </tr>
                </table>
              </form>
              
               