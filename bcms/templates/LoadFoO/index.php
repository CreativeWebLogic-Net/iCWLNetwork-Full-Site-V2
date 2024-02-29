<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{{html-title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="DC.Title" content="{{dc-title}}" />
    <meta name="description" content="{{meta_description}}" />
    <meta name="keywords" content="{{meta_keywords}}" />
    <meta name="robots" content="all" />
    <meta name="generator" content="Bubble CMS Lite" />
	<link rel="stylesheet" type="text/css" href="{{asset-sever}}bcms/templates/LoadFoO/css/style.css" media="screen" />
	<link rel="shortcut icon" href="{{asset-sever}}bcms/templates/LoadFoO/favicon.ico" />
	<script type="text/javascript" src="{{asset-sever}}bcms/templates/LoadFoO/js/textsizer.js"></script>
	<script type="text/javascript" src="{{asset-sever}}bcms/templates/LoadFoO/js/rel.js"></script>
</head>

<body>
<div id="wrap">
<div id="top">
<h2><a href="/" title="Back to main page">{{meta-title}}</a></h2>
<div id="menu">
<ul>
{{main-menu}}
</ul>
</div>
</div>
<div id="content">
  <div id="left">
  <h2>{{main-title}}</h2>
                {{main-content}}
</div>
<div id="right">
  <div class="box">
		<h2 style="margin-top:17px">Recent News</h2>
		{{side-bar}}
	</div>
</div>
<div id="clear"></div></div>
<div id="footer">
<p>&nbsp;&nbsp; <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a><br />
  <a href="http://creativeweblogic.info/">Website Design Development Promotion CreativeWebLogic.Net </a><br />
</p>
</div>
</div>
</body>
</html>