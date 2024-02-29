Hello
<div id="MainMenuManagement">
    <div id="ManagementMainMenu">
        <?php
        $empty_tags=true;
    $display_file=$app_data['MODULEBASEDIR']."menu/horizontal.php";
    if(file_exists($display_file)){
      include($display_file);
    }else{
      print "Error No File";
    }
 ?>
        
    </div>
</div>