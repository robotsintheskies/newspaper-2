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
			$categoryID = $category->term_id;
			$categorySlug = $category->slug;
			//The current category's featured subcategory
			$featuredCatTitle = "Featured $categoryName";
			$featuredCatSlug = "featured$categoryName";
			
			$featuredCatID= get_cat_ID($featuredCatTitle);
			
			$featured = get_cat_ID("Featured");
			
			$staffColumnsID = get_cat_ID("Staff Columns");
			$staffColumnsName = get_cat_name($staffColumnsID);
	?>
	
	<?php wp_head(); ?>
	<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.4/full/jquery.tools.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.simplyscroll.js"></script>
	<script type="text/javascript">
	 $(function(){
		
			$("#sub-menu-<?php echo($categoryName); ?> li").fadeIn(600);

				<?php
				if (!$category->parent == 0) { 
					
					$parentCatID = $category->parent;
					$parentCatName = get_cat_name($parentCatID);
					echo("$('#sub-menu-$parentCatName li').fadeIn(600);");
				}
				?>
		
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



</head>


<body>
	

	
	<div class="header category-inspiration">

			<?php get_header(); ?>

	</div>


	<div class="wrapper">
		<section class="featuredInCat">
			
			<?php
			/*Declares a new instantiation of WP_Query for the featured posts*/
			$featuredCat_obj = new WP_Query();
			$featuredCat_obj->query(
				array(
					'category_name' => $featuredCatSlug,
					'showposts' => 1
				));?>
				
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
				while($featuredCat_obj->have_posts()) : 
					$featuredCat_obj->the_post();
					$wp_query->in_the_loop = true;
				?>
					<section id="<?php echo($featuredCatSlug); ?>">
					
						<article <?php
						//edits get_post_class, replacing category-featured with ""
						$featuredClasses = get_post_class(); 
						$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);
						$featuredString = implode(' ',$featuredClasses);
						echo("class=\"$featuredString category-featured$categorySlug\">");
						?>
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1> 
							<p class="byline">by <em><?php the_author_posts_link(); ?></em></p>
							<p><?php echo(get_the_excerpt()); ?><a href="<?php the_permalink(); ?>">Read On >></a></p>
						</article>
						<img src="<?php echo get_post_meta($post->ID, 'section_feature', true); ?>" />
					</section>
				
				<?php
					endwhile;
				?>
		</section>
		
		
		
	<section class="storiesInCat">
		
		<aside class="studentGallery">
			<?php
			$studentGalleryID = get_cat_ID("Student Gallery");
			//LOOP
			query_posts(array(
				'cat'=>$studentGalleryID
				));
			while(have_posts()):
				the_post();?>
				
			 <a href="<?php the_permalink(); ?>"><img src="<?php echo get_post_meta($post->ID, 'gallery_thumb', true); ?>" /></a>


			<?php
			endwhile;
			?>
		</aside>
	<section class="currentStoriesInspiration">	
		<?php
			//Regular expression to hide images within posts
			add_filter('the_content','wpi_image_content_filter',11);
			function wpi_image_content_filter($content){

		     			$content = preg_replace("/<img.*?>/i","", $content);
						$content = preg_replace("/<object.*?>.*?<\/object.*?>/i","", $content);
						$content = preg_replace("/<div class=\"video_wrap html5video\">.*?<\/script>/i","",$content);
						$content = preg_replace("/<div id=.*?class=\"wp-caption.*?>.*?<\/div>/s","",$content);

		   			return $content;
			}?>
		<?php
		//LOOP
		$contests = get_cat_ID("Contests");
		query_posts(array(
			'cat'=>$categoryID,
			'category__not_in'=>array($featuredCatID,$studentGalleryID,$contests),
			'showposts'=>6
			));
		while(have_posts()):
			the_post();
		?>
	
				<div 
				<?php
				//edits get_post_class, replacing category-featured with ""
				$featuredClasses = get_post_class(); 
				$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);
		
				$featuredString = implode(' ',$featuredClasses);
				echo("class=\"$featuredString\">");
				?>
					
					<?php $authorNicename = get_the_author_meta('user_nicename'); ?>
					<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
							<a href="<?php the_permalink(); ?>">
					         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
							</a>
					<?php endif; ?>	
					<?php
					if (! in_category(array('Staff Columns','Columns'))) {	?>
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

		

			<?php 
			endwhile; 
			?>
			
			
		</section>
	</section>
	
	
	</div>
	

			<?php get_footer(); ?>
