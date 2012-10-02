<!DOCTYPE html>

<html class="breakingnews">

<head>
	
	<title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />

<link rel="shortcut icon" href="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/favicon.ico">
   	<!--Type Kit-->
	<script type="text/javascript" src="http://use.typekit.com/ojk4cnw.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
   <?php wp_head(); ?>
	
	
	<style type="text/css">
	
	
	</style>
	
	
	<?php wp_head(); ?>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-19864735-3']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script>
	       $(document).ready(function(){
	               $("#sub-menu-<?php echo($categoryName); ?> li").fadeIn(600);
					
					
					
					<?php
					if($category->parent == $staffColumnsID){
						echo("$('#sub-menu-Opinion li').fadeIn(600)");
					}elseif	(!$category->parent == 0) { 
						$parentCatID = $category->parent;
						$parentCatName = get_cat_name($parentCatID);
						echo("$('#sub-menu-$parentCatName li').fadeIn(600);");
					}
					?>
	       })
	</script>

</head>


<body>
	

	
	<header class="header category-breakingnews">

			<?php get_header(); ?>
			
			
	</header>
	
	<div class="wrapper breakingnews">
	
			<h1 class="breakingnews-header"><span>Breaking News</span></h1>
<!--
			
			<aside class="twitter-wrap">
			<h2>Latest Tweets</h2>
     	<?php /* twitter_messages('risdallnighter', 5, true, true, 'Tweeted', true, true, true); */ ?>
     </aside>   
-->
     
     <aside class="twitter-wrap">
     
     			<h2>Latest Tweets</h2>

			<ul id="twitter_update_list"></ul>

     </aside> 


     
		<div class="post-wrap">
		
<!-- 		<h2>Latest Posts</h2> -->
		<?php query_posts('category_name=breakingnews'); ?>
		<?php while (have_posts()) : the_post(); ?>
        
    <article class="single breakingnews">

      <h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h1>
     <time><?php the_date(); ?></time>
      <?php the_content(); ?>
			
			<a href="<?php the_permalink(); ?>" class="comments-link"><?php comments_number('No comments', '1 comment', '% comments'); ?> &gt;&gt;</a>
			
   </article>

		<?php
		endwhile;
		?>
		
		</div>

	</div>
	<div id="footer">
	
	<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/RISDAllNighter.json?callback=twitterCallback2&amp;count=5"></script>

		<?php get_footer(); ?>