<?php
    
	//echo $current_dir;
	session_start();
	ini_set( 'display_errors', '1' );
	//------------------------------------------------
	if(isset($_SESSION["administratorsID"])){
		$loc="Location: main/logged-in/index.php";
		header($loc);
		ob_end_flush();
		exit();
	}

	//----------------------------------------------------------------
	if(isset($_GET['dcmsuri'])){
		//print "--".$_GET['dcmsuri']."--";
		if(substr($_GET['dcmsuri'],strlen($_GET['dcmsuri'])-1)!="/"){
			$DisplayFile=".".$_GET['dcmsuri'];
			//print $DisplayFile." - ";
			if(file_exists($DisplayFile)){
				$ForbiddenExtensions=array("php");
				$ShowFile=true;
				if(strlen($DisplayFile)>3){
					if(in_array(substr($DisplayFile,strlen($DisplayFile)-3),$ForbiddenExtensions)){
						$ShowFile=false;	
					}else{
						$ShowFile=true;
					}	
				}else{
					$ShowFile=false;	
				}
				if($ShowFile){
					//$ContType=exec("file -bi '$DisplayFile'");
					$ContType=mime_content_type($DisplayFile);
					$head="Content-Type: $ContType";
					header($head);
					print $head;
					print file_get_contents($DisplayFile);
					//ob_end_flush();
					exit();
				}else{
					//ob_end_flush();
					exit();	
				}
			}else{
				//print $DisplayFile." - 404 File Not Found";
				header("HTTP/1.1 404 Not Found");
			}
		}
	}

	function Get_HTML_Tags(){
		$tag_array=array("a","abbr","acronym","address","applet","article","aside","audio","b","basefont","bdi","bdo","big","blockquote","body","button",
		"canvas","caption","center","cite","code","colgroup","data","datalist","dd","del","details","dfn","dialog","dir","div","dl","dt","em","fieldset",
		"figcaption","figre","font","footer","form","frame","frameset","h1","head","header","html","i","iframe","ins","kbd","label","legend","li","main","map","mark","meter",
		"nav","noframes","noscript","object","ol","optgroup","option","output","p","param","picture","pre","progress","q","rp","rt","ruby","s","samp",
		"script","section","select","small","span","strike","strong","style","sub","summary","sup","svg","table","tbody","td","template","textarea",
		"tfoot","th","thead","time","title","tr","tt","u","ul","var","video");
		$tag_void_array=array("area","base","br","col","embed","hr","img","input","link","meta","source","track","wbr","!DOCTYPE");
		return array($tag_array,$tag_void_array);
	}
	
	//$all_html_tags=Get_HTML_Tags();
	//print_r($all_html_tags);
	//----------------------------------------------------------------
	function callback($buffer)
	{
		// replace all the apples with oranges
		//return (str_replace("Yamba", "oranges", $buffer));
		//$buffer="\n".$buffer;
		//$buffer = trim($buffer," \t\n\r"););
		//echo"\n<br>666-----------------------------------------------------------------------------\n <br>";


		
		global $tag_match_array;
		//print_r($tag_match_array);
		$all_html_tags=Get_HTML_Tags();
		$html_tags=$all_html_tags[0];
		$html_void_tags=$all_html_tags[1];
		//print_r($all_html_tags);
		//$buffer=var_export($all_html_tags,true).$buffer;
		$sub_string_total="xx";
		$match_array=array();
		$inner_array=array();
		$search=0;
		$buffer_size=strlen($buffer);
		$query="";
		$str_match="";
		$cur_match=array(); 
		$inner_match=array();
		$start_count=array();
		$end_count=array();
		$open_char=array("{","<");
		$close_char=array("}",">");
		$custom_char=array($open_char[0],$close_char[0]);
		$html_char=array($open_char[1],$close_char[1]);
		$tag_array=array("custom"=>$custom_char,"html"=>$html_char);
		$tag_array_count=array("custom"=>2,"html"=>1);
		$current_tag=0;
		while($search<=$buffer_size){
			$sub_string = substr($buffer, $search, 1);
			foreach($tag_array as $tag_type=>$tag_val){
				//$start_count=0;
				//$cur_match="";
				//$buffer="\n tv-".$start_count."-".$end_count."-".$cur_match."-".var_export($tag_val,true).$buffer."\n";
				if($sub_string==$tag_val[0]){
					if(!isset($start_count[$tag_type])) $start_count[$tag_type]=0;
					if(!isset($cur_match[$tag_type])) $cur_match[$tag_type]="";
					$start_count[$tag_type]++;
					$cur_match[$tag_type].=$sub_string;
					//$buffer=$buffer."\n -22".$sub_string."-".$tag_val[0]."-33- \n";
				}elseif($sub_string==$tag_val[1]){
					if(!isset($end_count[$tag_type])) $end_count[$tag_type]=0;
					if(!isset($cur_match[$tag_type])) $cur_match[$tag_type]="";
					$end_count[$tag_type]++;
					$cur_match[$tag_type].=$sub_string;
					//$buffer=$buffer."\n -223".$sub_string."-".$tag_val[1]."-334- \n";
				}else{
					if($start_count[$tag_type]>0){
						$cur_match[$tag_type].=$sub_string;
						$inner_match[$tag_type].=$sub_string;
						//$buffer=$buffer."\n -224".$sub_string."-".$cur_match[$tag_type]."-35- \n";
					}
				}
				//if(($start_count[$tag_type]>$tag_array_count[$tag_type])&&($end_count[$tag_type]>$tag_array_count[$tag_type])){
				$match_count=$tag_array_count[$tag_type]-1;
				//if(($start_count[$tag_type]>0)&&($end_count[$tag_type]>0)){
				if(($start_count[$tag_type]>$match_count)&&($end_count[$tag_type]>$match_count)){
					$current_tag++;
					$match_array[$current_tag]['html']=$cur_match[$tag_type];
					$inner_array[$current_tag]['html']=$inner_match[$tag_type];
					$cur_match[$tag_type]="";
					$inner_match[$tag_type]="";
					$start_count[$tag_type]=0;
					$end_count[$tag_type]=0;
					$tag_string=$match_array[$current_tag]['html'];
					$tag_string=substr($tag_string,1,-1);
					if(substr($tag_string,-1)=='/'){
						$tag_string=substr($tag_string,0,-1);
					}
					$tag_attributes=explode(' ',$tag_string);
					$tag_attr_list = array_slice($tag_attributes, 1);
					foreach($tag_attr_list as $attr_key=>$attri_val){
						if (str_contains($attri_val, '=')) {
							$match_array[$current_tag]['attributes'][]=$attri_val;
						}
					}
					//$match_array[$current_tag]['attributes']=$tag_attr_list;
					$tag_name=$tag_attributes[0];
					$match_array[$current_tag]['tag_name']=$tag_name;
					if(in_array($tag_name,$html_tags)){
						$match_array[$current_tag]['tag_type']="html";
					}elseif(in_array($tag_name,$html_void_tags)){
						$match_array[$current_tag]['tag_type']="void";
					}
				}
			}
			//$buffer=$buffer."\n -1".var_export($match_array,true)."-2- \n";
			$search++;
			
		}
		$set_dimentions=true;
		$tag_count=0;
		$parent=0;
		while($set_dimentions==true){
			if($start_tag_count==0){
				if($match_array[$tag_count]['tag_type']=="void"){
					$match_array[$tag_count]['parent']=$parent;
					$start_tag_count=0;
				}else{
					$tag_search_name=$match_array[$tag_count]['tag_name'];
					$start_tag_count=$tag_count;
				};
			}else{

			}
			
			if (str_contains($tag_search_name, '/')) {
				
				$end_tag_search_name=substr($tag_string,1);
				if($end_tag_search_name==$tag_search_name){
					
				}
					$end_tag_search_name=$tag_search_name;
				}
			}
			if($tag_search_name)
			$tag_count++;
		}
		/*
		for($x=0;$x<count($match_array);$x++){
			if(isset($tag_match_array[$inner_array[$x]])){
				$query.="| ".$x." |\n ".$inner_array[$x]."\n--".$match_array[$x]."=>".$tag_match_array[$inner_array[$x]];//var_export($tag_match_array[$inner_array[$x]],true);
				$buffer=str_replace($match_array[$x], $tag_match_array[$inner_array[$x]], $buffer);
			}else{
				$buffer=str_replace($match_array[$x], "", $buffer);
			}
			
		}
		*/
		
		/*
		//$buffer=$query."--".$buffer;
		$pos = strpos($buffer, "<");
		$buffer=substr($buffer, $pos);
		//$buffer=$pos.$buffer;
		//$buffer = trim($buffer);
		*/
		$buffer=var_export($match_array,true).$buffer;
		//$buffer="\n 666all done".$buffer;
		
		return $buffer;
	}
?>