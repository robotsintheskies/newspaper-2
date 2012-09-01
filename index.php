<!DOCTYPE html>
<html class="no-js" lang="en"> 

<head>
	
	<!-- Commented July 30th, 2012 by Philippe Cao -->
   
   <title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
   <meta charset="<?php bloginfo('charset'); ?>" />
   <meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
   <meta name="description" content="<?php bloginfo('description'); ?>">
  <!-- <link rel="stylesheet" href="http://localhost/all-nighter/wp-content/themes/newspaper-2/foundation.css" type="text/css" media="screen" /> -->
   <link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
   
	<link rel="shortcut icon" href="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/favicon.ico">
	<!--Type Kit-->
		
	
 <!-- Script for jQuery stuff -->
<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.4/full/jquery.tools.min.js"></script>


  	
	<?php wp_head(); ?> 
	
	<!-- Google Analytics -->
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
	<!--[if lt IE 9]>
	<h1>Please upgrade to IE 9.</a></h1>
	<![endif]-->

	
<div class="header">
	
      <!-- Retrieve and display the header (which is a separate .php file) -->
      <?php get_header(); ?>
   
</div>


<div id="feature">
	
		<?php
		
		/*This part decides the number of featured posts to scroll through*/
		
	   /*Declares a new instantiation of WP_Query for the featured posts*/
	   /*Above styling so that $num_of_posts can be used in the css*/
	   $featured_obj = new WP_Query();
	   $featured_obj->query(
	      array(
	         'category_name' => 'featured',
	         'showposts' => 6
	      ));
		
	   $index = 0;   
	   $num_of_posts = $featured_obj->post_count;

	   ?>
	
	<?php
		//Regular expression to hide images within posts
		add_filter('the_content','image_content_filter',11);
		function image_content_filter($content){
	     			$content = preg_replace("/<img.*?>/i","", $content);
					$content = preg_replace("/<object.*?>.*?<\/object.*?>/i","", $content);
					$content = preg_replace("/<div class=\"video_wrap html5video\">.*?<\/script>/i","",$content);
					$content = preg_replace("/<div id=.*?class=\"wp-caption.*?>.*?<\/div>/s","",$content);
					$content = preg_replace("/<div class=\"ngg-galleryoverview.*?<\/div>.*<\/div>/s","",$content);


	   			return $content;
		}?>
		
   	<?php
      /*FEATURED ARTICLE LOOP*/ 
      while($featured_obj->have_posts()) : 
         $featured_obj->the_post();
         $wp_query->in_the_loop = true;
   ?>

	
		
	
	<!-- This first part gets the large image for the feature article. Meta data 'wide feature' must be uploaded for it to work.  -->
      <div id='feature-bg' style="background-image: url('<?php echo get_post_meta($post->ID, 'wide_feature', true)?>');"> 
	
		<!-- It looks like this part puts the author name up and then links to people's pages if necesssary-->
         <div  <?php post_class(); ?>>
         	<div id="feature-title">
			<?php $authorNicename = get_the_author_meta('user_nicename'); ?>
		      <?php
		      if (! in_category(array('Columns'))) {   ?>
		         <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		      <?php
		      }else{?>
		         <h1><?php if(in_category('tylerdibiasio')){?>
			      <a href="<?php bloginfo('url')?>/category/tylerdibiasio/">
				<?php
				}elseif(in_category('mishatownsend')){?>
				 	<a href="<?php bloginfo('url')?>/category/mishatownsend/">	
				<?php
				}
				elseif(in_category('korwinbriggs')){?>
				 <a href="<?php bloginfo('url')?>/category/korwinbriggs/">	
				<?php
				}
				elseif(in_category('thefinerthings')){?>
				 <a href="<?php bloginfo('url')?>/category/thefinerthings/">	
				<?php
				}
				elseif(in_category('risdinrome')){?>
				 <a href="<?php bloginfo('url')?>/category/risdinrome/">	
				<?php
				}
				elseif(in_category('twogirls')){?>
				 	<a href="<?php bloginfo('url')?>/category/twogirls/">

				<?php }?><?php the_title(); ?></a></h1>
		      <?php   
		      }?>
				<p id= 'author'><?php the_author() ?> @ <?php the_time('Y/m/d'); ?></p>
			<!-- This links to the actual article. the_content refers to the actual post.  -->
           </div> 
         </div> 
      </div> 
        <?php endwhile; ?>

</div>
</div>


	



	<!--The section for the little stories-->
<div id= 'post-wrapper'>
   <?php

      /* Uses default query */ 

	/*I guess this queries all the category ID's and picks 6 to display? */ 
                $featured = get_cat_ID("Featured");
                $letters = get_cat_ID("Letters");
                $iCaughtYou = get_cat_ID("I Caught You");
                $events = get_cat_ID("Events");
           		$thisWeek = get_cat_ID("This Week at RISD");
           		$comics = get_cat_ID("Comics");
           	$weRecommend = get_cat_ID("We Recommend");
           	$studentGallery = get_cat_ID("Student Gallery");
           	$thisWeek = get_cat_ID("This Week At RISD");
           	$adviceUsers = get_users_with_role('advice_columnist');
           	$facultyquotes = get_cat_ID("Faculty Quotes");
           	$contests = get_cat_ID("Contests");
           	$breakingnews = get_cat_ID("Breaking News");
           	$adviceUsersString = mk_negative_user_ids($adviceUsers);
                query_posts(array(
           		'author'=>$adviceUsersString,
                   'category__not_in'=> array($featured,$letters,$iCaughtYou,$events,$studentGallery,$weRecommend,$comics,$facultyquotes,$contests,$breakingnews),
                   'showposts'=> 6,
                   ));
                $index = 0;
   ?>

 <?php
	//Regular expression to hide images within posts
	add_filter('the_content','wpi_image_content_filter',11);
	function wpi_image_content_filter($content){
     			$content = preg_replace("/<img.*?>/i","", $content);
				$content = preg_replace("/<object.*?>.*?<\/object.*?>/i","", $content);
				$content = preg_replace("/<div class=\"video_wrap html5video\">.*?<\/script>/i","",$content);
				$content = preg_replace("/<div id=.*?class=\"wp-caption.*?>.*?<\/div>/s","",$content);
				$content = preg_replace("/<div class=\"ngg-galleryoverview.*?<\/div>.*<\/div>/s","",$content);


   			return $content;
	}?>
 

   <?php 
      /*CURRENT STORIES (aka top six articles) LOOP*/
      /*$seen[] stores the IDs of all six posts, avoids repetition later on*/
      
      while(have_posts()):
      the_post();
      $seen[] = $post->ID;
      
   
         
   ?>
   
   
   

  <div class="post<?php the_category_unlinked(' '); ?>">
  	 <div class= 'news-bar'></div>  
      <?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
				<?php
				if (! in_category(array('Columns'))) {	?>
				<a href="<?php the_permalink(); ?>">
				<?php
				}else{?>
					<?php if(in_category('tylerdibiasio')){?>
				      <a href="<?php bloginfo('url')?>/category/tylerdibiasio/">
					<?php
				}
					?>
				<?php if(in_category('mishatownsend')){?>
				 	<a href="<?php bloginfo('url')?>/category/mishatownsend/">	
				<?php
				}
				elseif(in_category('korwinbriggs')){?>
				 <a href="<?php bloginfo('url')?>/category/korwinbriggs\">	
				<?php
				}
				elseif(in_category('twogirls')){?>
				 	<a href="<?php bloginfo('url')?>/category/twogirls/">
			
				<?php 
				}
				elseif(in_category('risdinrome')){?>
				 	<a href="<?php bloginfo('url')?>/category/risdinrome/">
			
				<?php 
				}
				elseif(in_category('thefinerthings')){?>
				 	<a href="<?php bloginfo('url')?>/category/thefinerthings/">
			
				<?php 
				}
				
				}?>
			
		         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
				</a>
      <?php endif; ?>


      	<?php
		if (! in_category(array('Columns'))) {	?>
			<h3 <?php the_category_unlinked(' '); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
		}else{?>
			<h3 <?php the_category_unlinked(' '); ?><?php if(in_category('tylerdibiasio')){?>
		      <a href="<?php bloginfo('url')?>/category/tylerdibiasio/">
			<?php
			}elseif(in_category('mishatownsend')){?>
			 	<a href="<?php bloginfo('url')?>/category/mishatownsend/">	
			<?php
			}
			elseif(in_category('korwinbriggs')){?>
			 <a href="<?php bloginfo('url')?>/category/korwinbriggs/">	
			<?php
			}
			elseif(in_category('risdinrome')){?>
			 <a href="<?php bloginfo('url')?>/category/risdinrome/">	
			<?php
			}
			elseif(in_category('thefinerthings')){?>
			 <a href="<?php bloginfo('url')?>/category/thefinerthings/">	
			<?php
			}
			elseif(in_category('twogirls')){?>
			 	<a href="<?php bloginfo('url')?>/category/twogirls\">
		
			<?php }?><?php the_title(); ?></a></h3 <?php the_category_unlinked(' '); ?><?php }?>
			<p id= 'author'><?php the_author() ?> @ <?php the_time('Y/m/d'); ?></p>
      <?php
      $string = get_the_content_our_way('Read More >>', FALSE);
               echo($string);
      ?>
      
 
      
      
     
      
   </div>
   
      
   <?php 
   

   endwhile; ?>   
   
</section>
</div>
</div>



      







 

