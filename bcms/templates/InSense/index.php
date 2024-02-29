<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{html-title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="DC.Title" content="{{dc-title}}" />
    <meta name="description" content="{{meta_description}}" />
    <meta name="keywords" content="{{meta_keywords}}" />
<link rel="shorcut icon" type="image/x-ico" href="{{asset-sever}}bcms/templates/InSense/favicon.ico" />
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset-sever}}bcms/templates/InSense/wp-layout-normal.css" title="normal"/>
<link rel="alternate stylesheet" type="text/css" href="{{asset-sever}}bcms/templates/InSense/wp-layout-large.css" title="large" />
<script type="text/javascript" src="{{asset-sever}}bcms/templates/InSense/javascript/imghover.js"> </script>
<script type="text/javascript" src="{{asset-sever}}bcms/templates/InSense/javascript/styleswitcher.js"> </script>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<?php wp_head(); ?>
</head> 
<body>

<!-- bgcontain & bgcontainIn START -->
<div id="bgcontain"><div id="bgcontainIn">

<!-- Header START -->
<div class="HeaderBG">
 <div class="Header">
 <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
 <div class="TagLine"><?php bloginfo('description'); ?></div>
 <div class="CornerLeft"></div><div class="CornerRight"></div>
 
   <div class="TopMenu">
    <ul>
      <li><a href="#Content">Skip to Content</a></li><li><a href="<?php echo get_option('home'); ?>">Home</a></li><li><?php wp_loginout(); ?></li>
    </ul>
  </div>
 
   <div class="WidthSize">
   Options:
    <ul>
      <li><a href="#" onclick="setActiveStyleSheet('normal'); return false;">Normal</a></li><li><a href="#" onclick="setActiveStyleSheet('large'); return false;">Large</a></li>
    </ul>
  </div>
</div> 
<!-- Header END -->

<!-- Menu START -->
<div class="Menu">
  <div class="MainMenu">
   <ul>
    <?php wp_list_pages('title_li='); ?> 
   </ul>
  </div>
  
  <div class="MainSyn">
  <ul>
   <li><a href="<?php bloginfo('rss2_url'); ?>"><span>Entries RSS</span></a></li>
   <li><a href="<?php bloginfo('comments_rss2_url'); ?>"><span>Comments RSS</span></a></li>
  </ul>
  </div>
  
</div>
 
</div> 
<!-- Menu END -->


<!-- Content START -->
<div id="Content">
<!-- Side ContentWrapper START -->
<div id="ContentWrapper">

<!-- Side SC START -->
<div class="SC">
<?php $countervariable=1; if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<div class="Post" style="padding-bottom: 50px;">

<div class="PostHead">
 <h1><a href="#"></a><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
 <p class="PostDate">
   <strong class="day"><?php the_time('d'); ?></strong>
   <strong class="month"><?php the_time('M'); ?></strong>
 </p>
  <p class="PostInfo">Posted by: <?php the_author() ?> in: <?php the_category(', ') ?> <?php edit_post_link('Edit', ''); ?></p>
</div>
  
<div class="PostContent">

<? if (is_home() && (!$paged || $paged == 1) || is_search() || is_single() || is_page()): ?> 
<?php the_content('Read the rest of this entry &raquo;'); ?>
<? else: ?><?php the_excerpt() ?><? endif; ?>
 </div>
 
<ul class="PostCom">
 <li><?php comments_popup_link('<strong>0</strong> Comments', '<strong>1</strong> Comment', '<strong>%</strong> Comments'); ?></li>
</ul>

</div>
<!-- Post END -->


<?php endwhile; ?>
<div class="Nav">
<?php posts_nav_link('','','<span class="Prev">Previous Entries</span>') ?>
<?php posts_nav_link('','<span class="Next">Next Entries</span>','') ?>
</div>
<?php else : ?>

<h2 class="center">Not Found</h2>
<p class="center"><?php _e("Sorry, but you are looking for something that isn't here."); ?></p>

<?php endif; ?> 
</div>
<!--  Side SC END -->

</div>
<!--  Side ContentWrapper END -->

<!-- Side Right - START -->
<div class="SR">

<!-- START Search -->
<div class="Search">
 <h3>Search</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
     <input type="text" name="s" class="keyword" style="width: 198px;" />
    </form>
 <div class="SearchCorner"></div>
</div>
<!-- END Search -->
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
<!-- START Categories -->  
  <div class="Categories">
   <h3>Categories</h3>
    <ul>
      <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?> 
   </ul>
   <div class="CategoriesCorner"></div>
   </div>
<!-- END Categories -->

<!-- START General -->
<div class="General Archives">   
 <h3>Archives</h3>
  <ul>
   <?php wp_get_archives('type=monthly'); ?>
  </ul>
 <div class="GeneralCorner"></div>
</div>
<!-- END General -->
   
<!-- START Links -->   
  <div class="General Links">
   <h3>Links</h3>
    <ul>
     <?php get_links('-1', '<li>', '</li>', '', FALSE, 'id', FALSE, 
FALSE, -1, FALSE); ?>

    </ul>
	<div class="GeneralCorner"></div>
   </div>
<!-- END Links -->


<!-- START Links -->   
  <div class="General Calendar">
   <h3>Calendar</h3>
     <?php get_calendar(daylength); ?>
	<div class="GeneralCorner"></div>
   </div>
<!-- END Links -->
<?php endif; ?>
</div> 
<!-- Side Right - END -->

</div>
<!-- Content END -->
 
<div class="Footer"><div class="FooterCorner"></div>
<?php include ($template_data['TEMPLATEPATH'] . "/403.php"); ?>
<p><strong>Copyright &copy; 2007 - <? bloginfo('name'); ?> - is proudly powered by <a href="http://www.wordpress.com/">WordPress</a></strong><br />
InSense 1.0 Theme by <a href="http://www.designdisease.com/">Design Disease</a> brought to you by <a href="http://www.hostgator.com/" title="HostGator Web Hosting">HostGator Web Hosting.</a></p>
<?php wp_footer(); ?>
</div>

</div></div>
<!-- bgcontain & bgcontainIn END -->

</body>
</html>

