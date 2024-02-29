<?php
    $page_name="";
    if(isset($_GET['sec1'])){
        $sections[0]=$_GET['sec1'];
        $page_name=$sections[0];
    }else{
        $page_name="index";
    }
    if(isset($_GET['sec2'])){
        $sections[1]=$_GET['sec2'];
        $page_name.="-".$sections[1];
    }
    if(isset($_GET['sec3'])){
        $sections[2]=$_GET['sec3'];
        $page_name.="-".$sections[2];
    }
    if(isset($_GET['sec4'])){
        $sections[3]=$_GET['sec4'];
        $page_name.="-".$sections[3];
    }
    $page_name.=".php";
    $include_file="./pages/".$page_name;

    print $include_file;
    $dir="./pages/";
    $files1 = scandir($dir);
    $file_sections=array();
    $user_level=array();
    $file_count=0;
    $section_tiers=array();
    $section_tiers_count=0;
    foreach($files1 as $file_name){
        /*
        if(!is_dir($file_name)){
            if (!file_exists($file_name)) {
        */      
        $extension=explode(".",$file_name);
        $file_ext=$extension[1];
        if($file_ext=="php"){
            //if($file_sections[$file_count][2]!=""){
                $file_ext=$extension[1];
                $section_array=explode("-",$extension[0]);
                $file_sections[$file_count]=array($file_name,$section_array,$file_ext);
                
                print_r($file_sections[$file_count]);
                        /*
                        $section_tiers_count=0;
                        for($x=0;$x++;$x<count($file_sections[$file_count][1])){
                            $current_section=$file_sections[$file_count][1][$x];
                            print_r($current_section);
                            
                            if (!in_array($current_section, $section_tiers)) {
                                
                                if(isset($section_tiers[$x])){

                                }else{
                                    $section_tiers[$x]=$file_sections[$file_count][1][$x];
                                }
                                
                                
                                $section_tiers[$x]=$file_sections[$file_count][1][$x];
                            }
                            
                        }
                        */
                    }
                    /*
                    if (!in_array($file_sections[$file_count][1][0], $user_level)) {
                        $user_level[]=$file_sections[$file_count][1][0];
                    }
                    */
                    /*
                    if (!in_array($file_sections[$file_count][1][0], $user_level)) {
                        $user_level[]=$file_sections[$file_count][1][0];
                    }
                    */
                    $file_count++;
                }else{
                    $file_ext="";
                    
                }
                
                //if (!in_array($file_sections[0], $user_level)) {
                    //$user_level[]=$file_sections[0];
                //}
                /*
            }
            */
        }
        
        
    }
    print_r($section_tiers);
    /*
    //include($include_file);
    $header_file
    $submenu_file
    $content_file
    $footer_file
    $end_of_file
  */  


?>