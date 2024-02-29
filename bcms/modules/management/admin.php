<pre><?php
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
    $all_sectons=array();
    $section_tiers=array();
    $section_tiers_count=0;
    foreach($files1 as $file_name){
        
        $all_sectons=array();
        $extension=explode(".",$file_name);
        if(isset($extension[1])){
            $file_base=$extension[0];
            $file_ext=$extension[1];
        }else{
            $file_base=array();
            $file_ext="";
        }
        
        if($file_ext=="php"){
            
                
            $section_array=explode("-",$file_base);
            $all_sectons=array($file_name,$section_array,$file_ext);
            $file_sections[$file_count]=$all_sectons;
            $current_sections=$section_array;
            /*
            if(5>$section_tiers_count){
                $set_sections=$current_sections[$section_tiers_count];
            //print_r($set_sections);
            //if ($set_sections, $section_tiers){
                $section_tiers[$section_tiers_count]=$set_sections;   
                $section_tiers_count++;
            }
            */
            $sec_count=0;
            $last_vaue="";
            for($x=0;$x<count($section_array);$x++){
                $cur_sec=$section_array[$x];
                if($x==0){
                    print "\n";
                }
                //print $x."-".$cur_sec." ";
                /*
                if($x>0){
                    $new_value=$last_vaue."_".$cur_sec;
                }
                */
                //$new_value=$cur_sec;
                $target_tier=&$section_tiers[$x];
                if(!isset($section_tiers[$x])){
                    $target_tier=$cur_sec;
                    //$section_tiers[$x]=$new_value;//$cur_sec;
                }else{
                    if(is_array($section_tiers[$x])){
                        if (!in_array($cur_sec, $section_tiers[$x])) {
                            $target_tier[]=$cur_sec;
                            //$section_tiers[$x][]=$new_value;//$cur_sec;
                        }
                    }else{
                        if ($section_tiers[$x]!=$cur_sec){
                                //$section_tiers[$x]=array($section_tiers[$x],$cur_sec);
                                $target_tier=array($section_tiers[$x],$cur_sec);
                                //$section_tiers[$x]=array($section_tiers[$x],$new_value);
                        }
                    }
                    
                    //if($section_tiers[$x]!=$cur_sec){
                        // $x."--".$cur_sec."-".$section_tiers[$x]." ";
                        //if($section_tiers[$x]==)
                        //print($section_tiers[$x]);

                        //$section_tiers[$x]=array($section_tiers[$x],$cur_sec);
                        /*

                        if(is_array($section_tiers[$x])){
                            $tarr=array($cur_sec);
                            $section_tiers[$x]=array_merge($section_tiers[$x],$tarr);
                        }else{
                            $section_tiers[$x]=array($section_tiers[$x],$cur_sec);
                        }
                       */
                    //}
                }
                $last_vaue=$cur_sec;
                
                /*
                if(isset($section_tiers[$sec_count])){
                    
                    if(is_array($section_tiers[$sec_count])){
                        $cur_sec=array($cur_sec);
                        $section_tiers[$sec_count]=array_merge($section_tiers[$sec_count],$cur_sec);
                    $tsec=array();
                    }else{
                        $section_tiers[$sec_count]=array($section_tiers[$sec_count],$cur_sec);
                    }
                    
                }else{
                    //if($section_tiers[$sec_count])
                    $section_tiers[$sec_count]=$cur_sec;
                }*/
            }
            
            
            $file_count++;
        }
              
    }
    //print_r($section_tiers);
    //print_r($file_sections);
    /*
    //include($include_file);
    $header_file
    $submenu_file
    $content_file
    $footer_file
    $end_of_file
  */  
  function get_pages($file_array,$level){
    $current_item_array=array();
    $all_items=array();
    $return_array=array();
    $file_item_array=array();
    $file_diff=0;
    foreach($file_array as $file_name){
        
        $all_sectons=array();
        $extension=explode(".",$file_name);
        if(isset($extension[1])){
            $file_base=$extension[0];
            $file_ext=$extension[1];
        }else{
            $file_base=array();
            $file_ext="";
        }
        
        if($file_ext=="php"){
            //$file_item_array[]=$file_name;
            if(count($file_item_array)==0){
                
                $file_item_array[$file_diff][]=$file_name;
                
            }
                
            $section_array=explode("-",$file_base);
            $section_count=count($section_array);
            if($section_count>$level){
                $current_item=$section_array[$level];
                //print $current_item;
                
                if(!in_array($current_item,$all_items)){
                    $file_diff++;
                    $all_items[]=$current_item;
                    //$current_item_array[$current_item]=array();
                    /*
                    $recursive_array=get_pages($file_array,$level+1);
                    if(count($recursive_array)>0){
                        //print_r($recursive_array);
                        $current_item_array[$current_item]=$recursive_array;
                    }
                    */
                    //print_r($recursive_array);
                    
                    //if(is_array($recursive_array)){
                    //    $current_item_array[$current_item]=$recursive_array;
                    //}
                    
                    
                }else{
                    $file_item_array[$file_diff][]=$file_name;
                    
                }
                
            }
            
        }
    }
    print_r($file_item_array);
    return $current_item_array;
  }
   
  $farr=get_pages($files1,0);
  echo"--666--";
    print_r($farr);
  

?></pre>