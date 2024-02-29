<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<title><?php print $content_data['db']['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['db']['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['db']['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['db']['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data['db']['GSiteMapMeta'];?>
<link rel="stylesheet" type="text/css" href="<?php print $app_data['asset-sever']; ?>bcms/templates/beautiful-night/rcstyle3.css" media="screen"/>

</head>
<body>
<div class="top">
  <div class="header">
    <div class="left"> <?php print $content_data['db']['Meta_Title'];?> </div>
    <div class="right">
      <h2>Beautiful Night</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="navigation"> <?php include($app_data['MODULEBASEDIR']."menu/horizontal.php");?>
    <div class="clearer"><span></span></div>
  </div>
  <div class="main">
    <div class="content">
      <h1><?php print $content_data['db']['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
    </div>
    
    <div class="clearer"><span></span></div>
  </div>
  <div style="color:#000"><a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a> | 
    <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a> </div>
</div>
</body>
</html>
