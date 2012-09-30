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
	
	<?php 
			//Use get_query_var to get the current category
			//Use get_category and then extract information (ID, Name, etc.)
			$catquery = get_query_var('cat');
			
			$category = get_category($catquery);
			
			$categoryName = $category->name;
		
			$categorySlug = $category->slug;
			$categoryID = $category->cat_ID;
				$categoryParentID = $category->parent;
				$categoryParentName = get_cat_name($categoryParentID);	
			//The current category's featured subcategory
			$featuredCatTitle = "Featured $categoryName";
			$featuredCatSlug = "featured$categoryName";
			
			$featuredCatID= get_cat_ID($featuredCatTitle);
			
			$featured = get_cat_ID("Featured");
			
			$staffColumnsID = get_cat_ID("Staff Columns");
			$staffColumnsName = get_cat_name($staffColumnsID);
	?>
	
	<style type="text/css">
	
	
	</style>
	
	
	<?php wp_head(); ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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
					//change color of parent category in the nav
					<?php
					if (!$category->parent == 0) { ?>
						$("li<?php echo(".$categoryParentName"); ?>").addClass("colorChanger<?php echo($categoryParentName)?>");
					<?php
					}else
					{?>
					$("li<?php echo(".$categoryName"); ?>").addClass("colorChanger<?php echo($categoryName)?>");
					
					<?php
					}?>
					//jquery for comments/letters tab box on the opinion page
					$(".letters p").hide();
					
					$(".lettersTab").click(showLetters);
					$(".commentsTab").click(showComments);
					
					$(".glass").hover(showSearch,hideSearch);
					
					
	       });
					function showLetters(){
						$(".recentComments ul").hide();
						$(".letters p").fadeIn();
						$(this).css("background-color","#e5e5e5");
						$(".commentsTab").css("background-color","#dedede");
					};
					function showComments(){
						$(".letters p").hide();
						$(".recentComments ul").fadeIn();
						$(this).css("background-color","#e5e5e5");
						$(".lettersTab").css("background-color","#dedede");
					};
					
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
	 _gaq.push(['_setAccount', 'UA-19149762-1']);
	 _gaq.push(['_trackPageview']);

	 (function() {
	   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	 })();

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
	
	
	<?php
	if (!$category->parent == 0) { 
		$categoryParentSlug = "sub$categoryParentName";
		?>
		<div class="header <?php echo($categoryParentSlug); ?>">

				<?php get_header(); ?>

		</div>
	<?php
	}else{
	?>
	<div class="header category-<?php echo($categorySlug); ?>">

			<?php get_header(); ?>

	</div>
	<?php
	}
	?>
		
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
		$categoryParentID = $category->parent;
		$categoryParentName = get_cat_name($categoryParentID);
		if (!$category->parent == 0) { ?>
			
				
					
				<?php include (TEMPLATEPATH . '/subcategory.php'); ?>
			
			
			            
		<?php
         }
		else{?>
			
			<!--Default Category Page-->
			
			
			<!-- Featured in Category -->
	
		<div class="wrapper">
		<section class="featuredInCat">
			
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
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo get_post_meta($post->ID, 'section_feature', true); ?>" />
						</a>
					</section>
				
				<?php
					endwhile;
				?>
		</section>
		
		<div class="wrapper">
		<section class="storiesInCat">
		<section class="currentStories">	
			<?php
			$letters = get_cat_ID("Letters");
			$facultyquotes = get_cat_ID("Faculty Quotes");
			$iCaughtYou = get_cat_ID("I Caught You");
			$adviceUsers = get_users_with_role('advice_columnist');
			$contests = get_cat_ID("Contests");
			$breakingnews = get_cat_ID("Breaking News");
			$adviceUsersString = mk_negative_user_ids($adviceUsers);
			$comics = get_cat_ID("Comics");
		      query_posts(array(
				// 'author'=>$adviceUsersString,
				'cat'=>$categoryID,
				'category__not_in'=>array($featuredCatID,$letters,$iCaughtYou,$comics,$facultyquotes,$contests,$breakingnews),
				'showposts'=>6,
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
						
					
						<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
							<?php
							if (! in_category(array('Columns'))) {	?>
							<a href="<?php the_permalink(); ?>">
							<?php
							}else{?>
								<?php if(in_category('tylerdibiasio')){?>
							      <a href="<?php bloginfo('url')?>/category/tylerdibiasio\">
								<?php
							}
								?>
							<?php if(in_category('mishatownsend')){?>
							 	<a href="<?php bloginfo('url')?>/category/mishatownsend\">	
							<?php
							}
							elseif(in_category('korwinbriggs')){?>
							 <a href="<?php bloginfo('url')?>/category/korwinbriggs\">	
							<?php
							}
							elseif(in_category('twogirls')){?>
							 	<a href="<?php bloginfo('url')?>/category/twogirls\">
						
							<?php 
							}
							
							}?>
						
					         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
							</a>
						<?php endif; ?>	
						<?php
						if (! in_category(array('Columns'))) {	?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
						}else{?>
							<h2><?php if(in_category('tylerdibiasio')){?>
						      <a href="<?php bloginfo('url')?>/category/tylerdibiasio\">
							<?php
							}elseif(in_category('mishatownsend')){?>
							 	<a href="<?php bloginfo('url')?>/category/mishatownsend\">	
							<?php
							}
							elseif(in_category('korwinbriggs')){?>
							 <a href="<?php bloginfo('url')?>/category/korwinbriggs\">	
							<?php
							}
							elseif(in_category('twogirls')){?>
							 	<a href="<?php bloginfo('url')?>/category/twogirls\">
						
							<?php }?><?php the_title(); ?></a></h2>
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
		<!--Ends else-->
		<?php }?>
	</div>

	
	

		<?php get_footer(); ?>
