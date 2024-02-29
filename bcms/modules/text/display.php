<?php
	$log->general("-yxz Text Display->",3);
	//print "-x-";
	if(isset($text_data["db"]['content_text'])){
	    
	    $cur_str=ltrim($text_data["db"]['content_text'],"\n\r\t\v\x00");
	}else{
	    $cur_str="";
	}

	//print "-y|-".$cur_str."-| y-\n\n";
	
	//print file_get_contents($DisplayFile);
	//ob_end_flush();
	//exit();
	/*
	if(check_base64($cur_str)){
		$decoded_cur_str=trim(base64_decode($cur_str));

		//$ContType=mime_content_type($decoded_cur_str);
		$ContType='image/icon';
		$head="Content-Type: $ContType";
		header($head);
		//print $head;
		print $decoded_cur_str;
	}else{
		print $cur_str;
	}
	*/
	print $cur_str;
	
	//exit();
	//echo"xx";
	/*
	if(isset($text_data["db"]['content_text'])){
		$str=$text_data["db"]['content_text'];
		//$str = ltrim($str," \t\n\r");
		//print $str;
		
		/*$ContType=mime_content_type($str);
			$head="Content-Type: $ContType";
			header($head);
			//print $head;
		*//*
		//print base64_decode($str);
		print $str;
	}
	*/
	/*//if(is_base64($str)){
		$ContType=mime_content_type($DisplayFile);
		$head="Content-Type: $ContType";
		header($head);
		print $head;
		print base64_decode($str);
	}else{
		//print "xx1";
		print base64_decode($str);
		//print $str;
	}*/
	
?>