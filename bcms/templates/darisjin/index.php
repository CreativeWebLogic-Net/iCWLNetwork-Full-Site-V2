<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php print $content_data['db']['Meta_Title'];?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="DC.Title" content="<?php print $content_data['db']['Meta_Title'];?>" />
        <meta name="description" content="<?php print $content_data['db']['Meta_Description'];?>" />
        <meta name="keywords" content="<?php print $content_data['db']['Meta_Keywords'];?>" />
        <link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
        <?php print $domain_data['db']['GSiteMapMeta'];?>
        <link href="<?php print $app_data['asset-sever']; ?>bcms/templates/darisjin/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div>
            <div class="header">
                &nbsp;
            </div>
            <div class="menubar">
                <?php include($app_data['MODULEBASEDIR']."menu/horizontal.php");?>
            </div>	
            <div class="middle">
                <div class="contentholder">
                    <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
                </div>
            </div>
            <div class="footer">
                <a href="https://creativeweblogic.net" class="footertext">Website Design</a>
                <span class="footertext">&nbsp; |&nbsp;&nbsp; </span>
                <a href="http://bubblecms.biz/" class="footertext">Website Builder</a>
            </div>
        </div>
    </body>
</html>
