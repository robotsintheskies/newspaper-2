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
		

	<?php 
			//Use get_query_var to get the current category
			//Use get_category and then extract information (ID, Name, etc.)
			$catquery = get_query_var('cat');
			
			$category = get_category($catquery);
			
			$categoryName = $category->name;
			$categoryID = $category->cat_ID;
			
			
			

			
			//The current category's featured subcategory
			$featuredCatTitle = "Featured $categoryName";
			$featuredCatSlug = "featured$categoryName";
			
			$featuredCatID= get_cat_ID($featuredCatTitle);
			
			$featured = get_cat_ID("Featured");
	?>
	
	<?php wp_head(); ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript"
	   src="http://cdn.jquerytools.org/1.2.4/jquery.tools.min.js"> 
	</script>
	<script>
	       $(document).ready(function(){
	               $("#sub-menu-<?php echo($categoryName); ?> li").fadeIn(600);
	
					<?php
					if (!$category->parent == 0) { 
						
						$parentCatID = $category->parent;
						$parentCatName = get_cat_name($parentCatID);
						echo("$('#sub-menu-$parentCatName li').fadeIn(600);");
					}
					?>	
					
					
					$(document).ready(function() {
					   $(".scrollable").scrollable();
					});
					
					
					$(".glass").hover(showSearch,hideSearch);
					
					//change color of parent category in the nav
					$("li<?php echo(".$categoryName"); ?>").addClass("colorChanger<?php echo($categoryName)?>");
					
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
	

	
	<div <?php
	//edits get_post_class, replacing category-featured with ""
	$featuredClasses = get_post_class(); 
	$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);

	$featuredString = implode(' ',$featuredClasses);
	echo("class=\"$featuredString header\">");
	?>

			<?php get_header(); ?>

	</div>
	
		
		
		
		
		<?php
			//Regular expression to hide images within posts
			add_filter('the_content','wpi_image_content_filter',11);
			function wpi_image_content_filter($content){
					if (is_category()){
		     			$content = preg_replace("/<img.*?>/i","", $content);
						$content = preg_replace("/<object.*?>.*?<\/object.*?>/i","", $content);
						$content = preg_replace("/<div class=\"video_wrap html5video\">.*?<\/script>/i","",$content);
						$content = preg_replace("/<div id=.*?class=\"wp-caption.*?>.*?<\/div>/s","",$content);
						$content = preg_replace("/<div class=\"ngg-galleryoverview.*?<\/div>.*<\/div>/s","",$content);
		    		}

		   			return $content;
			}?>
		
			
	
		
		<?php
		
		if (!$category->parent == 0) { ?>
			
			<?php include (TEMPLATEPATH . '/subcategory.php'); ?>
			
            
		<?php
         }
		else{?>
			
			<!--Spotlight Category Page-->
			
			<div class="featuredSpotContainer">

						<?php
						/*Declares a new instantiation of WP_Query for the featured posts*/
						$featuredCat_obj = new WP_Query();
						$featuredCat_obj->query(
							array(
								'category_name' => $featuredCatSlug,
								'showposts' => 1
							));

							/*FEATURED ARTICLE LOOP*/ 
							while($featuredCat_obj->have_posts()) : 
								$featuredCat_obj->the_post();
								$wp_query->in_the_loop = true;
							?>

								<section class="heroSpot" style="background-image: url('<?php echo get_post_meta($post->ID, 'wide_feature', true)?>');"> 
									<article 
									<?php
									//edits get_post_class, replacing category-featured with ""
									$featuredClasses = get_post_class(); 
									$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);

									$featuredString = implode(' ',$featuredClasses);
									echo("class=\"$featuredString category-featuredspotlight\">");
									?>
										<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1> 
									</article>
								</section>

							<?php
								endwhile;
							?>
					</div>
		
		<div class="wrapperSpotlight">
		<?php
			//NOT WORKING
			$featuredSpotlightID = get_cat_ID("Featured Spotlight");
			$categoryChildren = get_categories(array(
				"parent"=>$categoryID,
				"exclude"=>$featuredSpotlightID,
				'orderby'=>'name',
				'order'=>'desc',
				
				));
			foreach($categoryChildren as $category){
				$categoryName = $category->name;
				$categoryID = $category->term_id;
				$categorySlug = $category->slug;
				?>
				
				
			
				<?php
				//LOOP

				query_posts(array(
					'cat'=>$categoryID,
					'showposts'=>12,
					));
				$num_of_posts = $wp_query->post_count;
				
				if(have_posts()):
				?>



				<div class="scroll">
					<h1><a href="<?php bloginfo('url')?>/category/spotlight/<?php echo($categorySlug); ?>"><?php echo ("$categoryName Spotlights"); ?></a></h1>
					<?php if($num_of_posts > 3): ?>
					<p class="rotatorPrev"><a class="prev">prev</a></p>
					<?php
					endif;
					?>
				    <div class="scrollable">
						<div class="items">

				<?php
				while(have_posts()):
					the_post();
					?>


			            <div class="current category-spotlight">
							<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
									<a href="<?php the_permalink(); ?>">
							         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
									</a>
							<?php endif; ?>
			                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			            </div>


			<?php

			endwhile;

			?>
				</div>

			     </div>	
			<?php if($num_of_posts > 3): ?>
			<p class="rotatorNext"><a class="next">next</a></p>
			<?php endif; ?>
				 </div>

			<?php
				endif;
			?>
				
	
				
			<?php
		}
			?>	

		

			<?php }?>
	</div>
	
	

			<?php get_footer(); ?>