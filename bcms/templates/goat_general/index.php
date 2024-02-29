<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{html-title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="DC.Title" content="{{dc-title}}" />
    <meta name="description" content="{{meta_description}}" />
    <meta name="keywords" content="{{meta_keywords}}" />
<link rel='shortcut icon' type='image/x-icon' href='{{asset-sever}}bcms/assets/favicon.ico' />
<?php print $domain_data['db']['GSiteMapMeta'];?>
<link href="{{asset-sever}}bcms/templates/goat_general/css/general.css" rel="stylesheet" type="text/css" />
<script src="{{asset-sever}}bcms/templates/goat_general/Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="{{asset-sever}}bcms/templates/goat_general/Scripts/function.js" type="text/javascript"></script>
<style>
body {
	background-image: url({{asset-sever}}bcms/templates/goat_general/images/bg.jpg);
	background-repeat: repeat-x;
	background-color:#d6d7d6;
	margin:0px;
	text-align:center;
}
</style>
</head>

<body>

<div id="MainBody" align="center">
	<div id="WhiteHeader">
        <div id="HeaderTop">      
            <div class="HeaderMenu">
            {{language-menu}}
            </div>
        </div>
        <div id="HeaderBanner">{{header-banner}}
      </div>
    </div>
    <div id="MenuHolder">
    	<div id="MainMenu">
  		{{main-menu}}
   	  </div>
         
    </div>
    <div id="MainBodyHolder">
		<div id="LeftPanel">
    		<div id="LeftPanelHeader">
        
        	</div>
            <div id="LeftPanelTitleHolder">
            	<div id="LeftPanelTitleBGBlack">
                &nbsp;
                </div>
                <div id="LeftPanelTitleBGGrey">
                <?php print $template_defs['news_title'];?>
                </div>
            </div>
            <div id="LeftPanelBodyHolder">
                <div id="LeftPanelBodyBG">
                	<div id="LeftPanelBodyBGGrey">
                  {{side-bar}}
                	</div>
                </div>
            </div>
    	</div>
   	  <div id="RightPanelHolder">
            <div id="RightPanel">
        		<span class="MainTitle"><br />
                </span>
                <span class="SubTitle">
                {{main-title}}
                </span>
                <p class="MainText">
                {{main-content}}
                </p>
            </div>
      </div>
   	
        <div id="ClearBody">
        
        </div>
        <div id="FooterHolder">
            <div id="FooterBGWhite">
                <div id="FooterBGGrey">
                  <div id="FooterTextLeft">
               	  <a href="http://bubblecms.biz/" target="_blank">Powered By Bubble CMS Lite</a>              </div>
                  <div id="FooterTextRight">
                  	<a href="http://creativeweblogic.info/" target="_blank"> Development  Creative Web Logic</a> 
                  </div>
                </div>
          </div>
        </div>
    </div>
    <div id="LanguageMap">
    </div>
</div>
</body>
</html>
