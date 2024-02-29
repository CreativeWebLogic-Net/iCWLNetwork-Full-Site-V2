<?php
	$log->general("-ab Text Display->",3);
    if(isset($module_data["db"]['dir'])){
	    $module_template_display=$app_data['MODULEBASEDIR'].$module_data["db"]['dir']."/".$module_data["db"]['filename'];
    	if(file_exists($module_template_display)){
    	    //print $module_template_display;
    		$log->general("-ar Text Display->".$module_template_display."-".var_export($module_data,true),3);
    		$text_data['debug'][]=$module_template_display;
    		include($module_template_display);
    	}else{
    	}
	}
?>