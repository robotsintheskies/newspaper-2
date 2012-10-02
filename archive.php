
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



</head>

 	
<body>
	

	
	<div class="header">

			<?php get_header(); ?>

	</div>
	
	<div class="archivesContainer">
		
	<?php if (have_posts()) : ?>

		 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		 	 
		 	  
		 	  
				<div id="MonthlyArchiveHeader"><h1 class="pagetitle">Archive for <?php the_time('F Y'); ?></h1></div>
		 	
		 	 
	
	
	
			<?php 
       
	
				//Regular expression to hide images within posts

				add_filter('the_content','wpi_image_content_filter',11);
				function wpi_image_content_filter($content){
					$content = preg_replace("/<img.*?>/i","", $content);
					$content = preg_replace("/<object.*?>.*?<\/object.*?>/i","", $content);
					$content = preg_replace("/<div class=\"video_wrap html5video\">.*?<\/script>/i","",$content);
					$content = preg_replace("/<div id=.*?class=\"wp-caption.*?>.*?<\/div>/s","",$content);
			    	

			    	return $content;
				}

			?>	
			
			<div id="MonthlyArchiveContainer">
			<?php
			while (have_posts()) : the_post(); ?>
	  
			  <div class="post<?php the_category_unlinked(' '); ?>" id="MonthlyArchiveArticle">
			  	<div class= "post bar <?php the_category_unlinked(' '); ?>"></div>  
				<a href='<?php the_permalink(); ?>'> <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
				</a>
				<a href=' <?php the_permalink(); ?>' class="post<?php the_category_unlinked(' '); ?>"><h3 ><?php the_title(); ?></h3></a>
				<p id= 'author'><?php the_author() ?> @ <?php the_time('Y/m/d'); ?></p>
				
			  </div>
						
						

			<?php endwhile; ?>
						</div>

			
	<?php endif;?>	
	<div class="clear"></div>
		</div>
	
	<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		       <div id="nav-below" class="navigation">
		         <div class="nav-previous"><?php next_posts_link(  'Older posts <span class="meta-nav">>></span>' ); ?></div>
		         <div class="nav-next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">>></span>'); ?></div>
		       </div>
		<?php endif; ?>
	
		</div>
	</div>

		<?php get_footer(); ?>
