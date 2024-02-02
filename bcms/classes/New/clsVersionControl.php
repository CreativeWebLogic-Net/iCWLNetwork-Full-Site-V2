<pre><?php

date_default_timezone_set('Australia/Sydney');
    function listFilesWithMD5($dir) {
        if (!is_dir($dir)) {
            echo "Error: $dir is not a valid directory.";
            return;
        }else{
            echo PHP_EOL.PHP_EOL."Folder: $dir " . PHP_EOL. PHP_EOL;
        }
        
        $files = scandir($dir);
        //print_r($files);
        
        foreach ($files as $file) {
            //if ($file !== '.' && $file !== '..') {
                if (is_dir($file)) {
                    listFilesWithMD5($file);
                }else{
                    
                        $path=$file;
                        $md5Hash = md5_file($path);
                        $size = filesize($path);
                        $date = date('Y-m-d H:i:s', filemtime($path));
                        echo "File: $lin_path | MD5: $md5Hash | Size: $size bytes | Date: $date" . PHP_EOL;
                }
           // }
            /*
            //if ($file !== '.' && $file !== '..') {
                $lin_path = $file;
                $path = $dir . '/' . $file;
    
                if (is_file($path)) {
                    $md5Hash = md5_file($path);
                    $size = filesize($path);
                    $date = date('Y-m-d H:i:s', filemtime($path));
                    echo "File: $lin_path | MD5: $md5Hash | Size: $size bytes | Date: $date" . PHP_EOL;
                } elseif (is_dir($path)) {
                    listFilesWithMD5($path);
                }
           // }
           */
        }
        
    }
    
    // Usage example:
    $directory = 'D:\Documents\Projects\Easy Bubble CMS\GitHub';
    listFilesWithMD5($directory);

?></pre>