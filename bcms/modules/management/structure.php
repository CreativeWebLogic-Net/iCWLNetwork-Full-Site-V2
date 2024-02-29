<pre>
<?php
    $main_pages=array();
    $main_pages[]=array("network.php");

    

    function listAllFiles($dir) {
        //
        $array = array_diff(scandir($dir), array('.', '..'));
        //print("---".var_export($array,true)."---\n");
        
    
        foreach ($array as &$item) {
           // if($dir!='../'){
                $item = $dir . $item;
            //}else{

            //}
      
    
        }
        unset($item);

        foreach ($array as $item) {
            $pos=strpos($item,'aws');
            //print("---=".$pos."---\n");
            if($pos==false){
                if (is_dir($item)) {
                    $array = array_merge($array, listAllFiles($item . '/'));
                }
            }

        }

    return $array;

    }
    function get_file($filename){
        if(filesize($filename)>0){
            $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        
        }else{
            $contents="";
        }
        //return base64_encode($contents);
        return $contents;
    }

    function get_file_parts($contents){
        $pos=strpos($contents,'?>');
        $start=substr($contents,0,$pos);
        return $start;
    }

    function get_includes($contents,$start,$end,$base_64=false){
        //print "\n -321- ".$contents.'== \n';
        $repeat=true;
        $include_arr=array();
        $cont=array();
        $conta_out="";
        do{
            //$pos=strpos($contents,'include(');
            $pos=strpos($contents,$start);
            //$finder='.php");';
            $pos2=strpos($contents,$end);
            //print "\n -AA321--"."d-".$pos."x-".$pos2." | ".$contents.'== \n';
            //$contents=substr($contents,$pos);
            //print "\n -123--".$contents.'== \n';
            //$pos2=strpos($contents,'.php");');
            $pos_t=$pos2-$pos+strlen($end);
            if($base_64==true){
             //   $conta=chunk_split(base64_encode(substr($contents,$pos,$pos_t)));
                //$conta= chunk_split($conta);
                $conta=substr($contents,$pos,$pos_t);
                //print "\n 1-321--"."d-".$pos."x-".$pos2." | ".$conta.'== \n';
                //$conta=chunk_split(base64_encode(gzcompress($conta)));
                $conta_out=chunk_split(base64_encode(gzcompress($conta)));
                //print "\n 2-321AAA--"."d-".$pos."x-".$pos2." | ".$conta.'== \n';
            }else{
                $conta=substr($contents,$pos,$pos_t);
                $conta_out=$conta;
            }
            ///print "\n -321--"."d-".$pos."x-".$pos2." | ".$conta.'== \n';
            $new_con=$pos+$pos_t;
            //print "\n -321--"."d-".$pos."x-".$pos2." | ".$contents.'== \n';
            $contents=substr($contents,$new_con);
            //print "\n -321--"."d-".$pos."x-".$pos2."=| ".$conta.'== \n';
            
            //if($conta!=""){
               //if($base_64==true){
                //print "\n -B64321---".$base_64.'== \n';
                //$conta=base64_encode($conta);
               //}
              // if($base_64==true){
              //      $valid_pos=strpos($conta);
               //}else{
                $valid_pos=strpos($conta,$start);
               //}
               if(is_int($valid_pos)){
                    //if($base_64==true){
                        $include_arr[]=$conta_out;
                    //}else{
                        //$include_arr[]=$conta_out;
                    //}
               }
                
            //}
            
            if(!$pos){
                $repeat=false;
                break;
            }
        }while ($repeat);
        //print_r($include_arr);
        return $include_arr;
    }
    

    $dir="../";
    $ret_arr=listAllFiles($dir);
    sort($ret_arr);
    $output=array();
    foreach ($ret_arr as $item) {
        $pos3=strpos($item,'admin/');
        $pos=strpos($item,'php');
        $pos2=strpos($item,'bak');
        if($pos3){
            if($pos2==false){
                if($pos!=false){
                    $cons="";//base64_encode($cons);
                    $cons=get_file($item);
                    $incs=get_includes($cons,'include(',');');
                    $main=get_includes($cons,'<form name="form1" method="post" action="">','</form>',true);
                    /*
                    $main_arr=array();
                    
                    foreach($main as $forms){
                        $main_arr[]=base64_encode($forms);
                    }
                    */
                    $main=base64_encode($main);
                    $cons=chunk_split(base64_encode(gzcompress($cons)));
                    
                    
                    
                    $output[]=array(substr($item,3),uniqid(),$cons,$incs,$main);
                }
            }
        }
        
        
        
    }
    print("---".var_export($output,true)."---\n");
?><pre>