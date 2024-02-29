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
		//$html = '<p>Hello, <b>world!</b></p>';

		$dom = new DOMDocument();
		$dom->loadHTML($buffer);

		$elements = $dom->getElementsByTagName('*');

		$result = array();

		foreach ($elements as $element) {
			$tag = $element->tagName;
			$attributes = array();

			foreach ($element->attributes as $attr) {
				$attributes[$attr->name] = $attr->value;
			}

			$children = array();

			foreach ($element->childNodes as $child) {
				if ($child->nodeType == XML_TEXT_NODE) {
					$children[] = $child->nodeValue;
				} else {
					$children[] = array(
						'tag' => $child->tagName,
						'attributes' => $child->hasAttributes() ? $child->getAttributes($child) : null,
						'children' => $child->getChildren($child)
					);
				}
			}

			$result[] = array(
				'tag' => $tag,
				'attributes' => $attributes,
				'children' => $children
			);
		}

		print_r($result);
		$buffer=var_export($result,true).$buffer;
		return $buffer;
	}
?>