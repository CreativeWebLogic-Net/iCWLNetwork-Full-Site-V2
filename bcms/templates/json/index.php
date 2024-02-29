<?php
    //ob_end_flush();
    //ob_start("callback_menu");
    //ob_start("callback_all");
    //$ob_buffer->add_callback();
    //print "start_menu";
    ob_start("callback_output");
    include($app_data['MODULEBASEDIR']."menu/horizontal.php");
    $menu_buffer = base64_encode(ob_get_contents());
    ob_end_clean();
    $menu_data["output_html"]=$menu_buffer;
    //ob_end_flush();
    //ob_start("callback_content");
    //ob_start("callback_all");
    //$ob_buffer->add_callback();
    ob_start("callback_main_output");
    include($app_data['MODULEBASEDIR']."content/display.php");
    ob_end_clean();
    $buffer = base64_encode(ob_get_contents());
    
    //ob_start("callback_logs");
    //ob_start("callback_all");
    //$ob_buffer->add_callback();
    $res_array=array();
    $res_array["domain"]=$domain_data;
    $res_array["domain_user"]=$domain_user_data;
    $res_array["menu"]=$menu_data;
    $res_array["page"]=$content_data;
    $res_array["text"]= $text_data;
    $res_array["module"]=$module_data;
    $res_array["main_content"]=$buffer;
    $jsonString = json_encode($res_array, JSON_PRETTY_PRINT);

    //print_r($res_array);
    
    print $jsonString;
    //ob_end_flush();
    //ob_start("callback_template_end");
    //ob_start("callback_all");
    //$ob_buffer->add_callback();