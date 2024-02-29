<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>{{html-title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="DC.Title" content="{{dc-title}}" />
    <meta name="description" content="{{meta_description}}" />
    <meta name="keywords" content="{{meta_keywords}}" />
	<link rel='shortcut icon' type='image/x-icon' href='{{asset-sever}}bcms/assets/favicon.ico' />
    <?php print $domain_data["db"]['GSiteMapMeta'];?>
    <meta name="robots" content="all" />
    <meta name="generator" content="Bubble CMS Lite" />
	<link href="{{asset-sever}}bcms/templates/metamorph_greeny/styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="content">
<div id="back">
<!-- header begins -->
<div id="header"> 
	<div id="logo">
		<h1><a href="/">{{meta-title}}</a></h1>
		<h2>&nbsp;</h2>
	</div>
  <div id="menu">
		<ul>
		{{main-menu}}
		</ul>
  </div>
</div>

<!-- header ends -->
<!-- content begins -->
 <div id="main">
	<div id="right">	
		  			
			
		<div class="title_back"> </div>
			<h3>Company News</h3>
			<div class="title_back">
			{{side-bar}}
		  </div>
	</div>
	<div id="left">		
				<div class="left_box">
				<h2>{{main-title}}</h2>
                {{main-content}}
			</p>
<p class="date">&nbsp;</p>
				</div>
	</div>
	<div style="clear: both;">&nbsp;</div>
<!--content ends -->
<!--footer begins -->
	</div>

<div id="footer"><p>
<a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a> | 
<a href="http://creativeweblogic.info/">Website Design Development Promotion Creative Web Logic</a></p>
	</div>
</div>
</div>
</body>
</html>