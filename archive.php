
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



</head>


<body>
	

	
	<div class="header">

			<?php get_header(); ?>

	</div>
	
	<div class="archivesContainer">
		
	<?php if (have_posts()) : ?>

		 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		 	 
		 	  <?php /* If this is a daily archive */ if (is_day()) { ?>
				<h1 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h1>
		 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h1>
		 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
			 
		 	 
		 	  <?php } ?>
	
	
			<?php 
         global $query_string;
			$events = get_cat_ID("Events");
			$iCaughtYou = get_cat_ID("I Caught You");
			$events = get_cat_ID("Events");
			$studentGallery = get_cat_ID("Student Gallery");
			$weRecommend = get_cat_ID("We Recommend");
			$letters = get_cat_ID("Letters");
         $cat_string = 
             "-$iCaughtYou,-$events,-$studentGallery,-$weRecommend,-$letters";
			query_posts($query_string . "&cat=$cat_string");
	
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
			
			<div class="archivesContentHolder">
			<?php
			while (have_posts()) : the_post(); ?>
					<div 
					<?php
					//edits get_post_class, replacing category-featured with ""
					$featuredClasses = get_post_class(); 
					$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);
			
					$featuredString = implode(' ',$featuredClasses);
					echo("class=\"$featuredString archivePost\">");
					?>
						
						<?php $authorNicename = get_the_author_meta('user_nicename'); ?>
						<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
							<img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
						<?php endif; ?>	
						<?php
						if (! in_category(array('Opinions','Staff Columns','Lifestyle','Columns'))) {	?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
						}else{?>
							<h2><a href="<?php bloginfo('url')?>/author/<?php echo($authorNicename)?>"><?php the_title(); ?></a></h2>
						<?php	
						}?>
						<p class="byline">by <em><?php the_author_posts_link(); ?></em></p>
						<?php
						$string = get_the_content_our_way('Read More >>', FALSE);
						          echo($string);
						?>
						
						<ul class="post-categories">
						<?php 
						$categories = get_the_category();      // get an array of category objects

						       foreach ($categories as $category) {    
						                 if (! $category->parent) {
						                    continue; 
						                 }
						                 if (preg_match('/feature/i',$category->name)) {
						                    continue; 
						                 }
										 $childCatID = $category->cat_ID;
										 $childName = $category->name;
										 $childLink = get_category_link($childCatID);   
						                  break;
						               }               
						              echo("<li><a href=$childLink>$childName</a></li>");              
						?>
						</ul>
						<span class="commentNumber"><a href="<?php the_permalink(); ?>"><?php comments_number('(+)','(1)','(%)'); ?></a></span>
					
					</div>

			<?php endwhile; ?>
			
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
