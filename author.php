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
	<?php wp_head(); ?>
	
	<?php 
			//Use get_category and then extract information (ID, Name, etc.)
			$categories = get_the_category();
			
			foreach($categories as $category){
				if (preg_match('/feature/i',$category->name)) {
                    continue; 
                 }
                 if ($category->parent == 0) {
                    continue; 
                 }
                 
					$parentCatID = $category->parent;
					$parentName = get_cat_name($parentCatID);
					
					break;
			}
				
				
			
	?>
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
	
	<div class="authorContainer">


	<!-- This sets the $curauth & $authid variables -->
	<?php
	if(get_query_var('author_name')) :
	$curauth = get_userdatabylogin(get_query_var('author_name'));
	else :
	$curauth = get_userdata(get_query_var('author'));
	endif;
	$authid = $curauth->ID;
	?>
	
	<div class="bio">
		<?php userphoto($wp_query->get_queried_object()); ?>
		<h1>
			<?php
			if($curauth->user_url):
			?>
			<a href="<?php echo $curauth->user_url; ?>">
			<?php
			endif;
			?>	
			
				<?php echo $curauth->display_name; ?>
				
			</a>
			
		</h1>

		<p><?php echo $curauth->description; ?></p>
		<div class="spacerAuthor"></div>
	</div>

	<section class="authorStories">

		<ul>
			<!-- The Loop -->
			<?php 
			         global $query_string;
			                          $iCaughtYou = get_cat_ID("I Caught You");
										$facultyQuotes = get_cat_ID("Faculty Quotes");
			                          $events = get_cat_ID("Events");
			                          $studentGallery = get_cat_ID("Student Gallery");
			                          $weRecommend = get_cat_ID("We Recommend");
			                          $letters = get_cat_ID("Letters");
			         $cat_string = "-$iCaughtYou,-$events,-$studentGallery,-$weRecommend,-$letters,-$facultyQuotes";
			                           query_posts($query_string . "&cat=$cat_string");
			if (have_posts()) : ?>
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
   			<?php while (have_posts()) : the_post(); ?>
      			<div 
				<?php
				//edits get_post_class, replacing category-featured with ""
				$featuredClasses = get_post_class(); 
				$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);

				$featuredString = implode(' ',$featuredClasses);
				echo("class=\"$featuredString\">");
				?>
			
			
			
				<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
			         	<a href="<?php the_permalink(); ?>">
				         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
						</a>
			      <?php endif; ?>	
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="byline">by <em><?php the_author_posts_link(); ?></em></p>
				<?php the_content('Read More >>', FALSE); ?>
				
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

   <?php else : ?>
      <!-- <p class="noAuthorPosts">No posts by this author.</p> -->
   <?php endif; ?>
<!-- End Loop -->
	</ul>
	
	
	</section>

	</div>
	
	
	</div>
	<?php get_footer(); ?>
	