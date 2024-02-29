<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['db']['Meta_Title'];?></title>
<meta name="DC.Title" content="<?php print $content_data['db']['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['db']['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['db']['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data['db']['GSiteMapMeta'];?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/blue/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="banner">
  <h1><?php print $content_data['db']['Meta_Title'];?></h1>
</div>
<div id="container">
  <div id="navbar">
    
    
    <ul class="list-menu" id="list-menu-id">
      <?php 
        $menu_data['spacers']=false;
        include($app_data['MODULEBASEDIR']."menu/li.php");
      ?>
    </ul>
  </div>
  
  <div id="content">
    <h1><?php print $content_data['db']['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
	  <br><br><br><br>
  </div>
  <div id="footer">
    <a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a> | 
    
      <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
  </div>
</div>
</body>
</html>