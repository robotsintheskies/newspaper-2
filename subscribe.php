<?php
/*
Template Name: Subscribe
*/
?>
<!DOCTYPE html>

<html>

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
	
	
	<style type="text/css">
	
	
	</style>
	
	
	<?php wp_head(); ?>
	<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.4/full/jquery.tools.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.simplyscroll.js"></script>
	<script type="text/javascript">
	 $(function(){
		$(".glass").hover(showSearch,hideSearch);
	});
	var mouseinglass = 0;
	      var mouseinsearch = 0;
	      var timer = 0;
	      function showSearch(){
	         $(".searchForm").show();
	         mouseinglass = 1;
	         $(".searchForm").hover(focusSearch,blurSearch);
	         timer = setTimeout("timesUp()",3000);
	      }
	      function focusSearch() {
	         mouseinsearch = 1;
	      }
	      function blurSearch() {
	         mouseinsearch = 0;
	      }
	      function hideSearch() { 
	         mouseinglass = 0;
	      }        
	      function timesUp() {
	         if ((! mouseinglass) && (! mouseinsearch)) {
	            $(".searchForm").fadeOut();
	            clearTimeout($timer);
	         }
	         else {
	            timer = setTimeout("timesUp()",3000);
	         }
	      }
	
	</script>

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
</head>


<body>
	

	
	<div class="header">

	      <?php get_header(); ?>

	</div>
	
	<div class="infoContainer">
	<?php
	while(have_posts()):
		the_post();
		?>
			<h1>E-mail Subscriptions</h1>
			<?php the_content(); ?>

	<?php
	endwhile;
	?>
	</div>
	
	


		<?php get_footer(); ?>