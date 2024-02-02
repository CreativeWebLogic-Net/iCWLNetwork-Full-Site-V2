<?php
    
    ob_start($app_data["include_callback"]);
		include($filepath);
    ob_end_flush();
?>