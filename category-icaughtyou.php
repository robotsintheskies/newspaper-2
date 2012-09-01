<?php
/*
Template Name: I Caught You
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
	
	<?php wp_head(); ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.masonry.min.js"></script>
	<script>
			
	       $(document).ready(function(){
		
					$("form#tdomf_form1 textarea").val("I Caught You...");
					$("form#tdomf_form1 textarea").click(function(){
						$("form#tdomf_form1 textarea").val("");
					});
					
					
	               $("#sub-menu-<?php echo($parentName); ?> li").fadeIn(600);
					
					$(".wrap").masonry({
						 singleMode: true,
						itemSelector: ".caughtYouContainerSingle",
						
					});
					
					
					
					<?php
					if (!$category->parent == 0) { 
						
						$parentCatID = $category->parent;
						$parentCatName = get_cat_name($parentCatID);
						echo("$('#sub-menu-$parentCatName li').fadeIn(600);");
					}
					?>	
					$(".glass").hover(showSearch,hideSearch);	
					
					//change color of parent category in the nav
					$("li.Lifestyle").addClass("colorChangerLifestyle");
					
					
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
			            clearTimeout(timer);
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
	
	<?php
	
	if (!$category->parent == 0) { 
		$categoryParentSlug = "sub$categoryParentName";
		?>
		<div class="header <?php echo($categoryParentSlug); ?>">

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
		    		}

		   			return $content;
			}?>
		
			
	<div class="wrapperUserSubmit">
		<?php
		if( have_posts()) :?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('iCaughtYou') ) : ?>
	         <?php endif; ?>
	
		<section <?php post_class("wrap"); ?>>
			
				
				
				<?php
				while( have_posts()) :
					the_post();

					global $more;    // Declare global $more (before the loop).
					$more = 1;       // Set (inside the loop) to display all content, including text below more.
					?>
				

						<div class="caughtYouContainerSingle">
							<?php /*edited by Daniel Hirunrusme 9/22/10*/ ?>
							<p class="caughtYouSingle">...<?php echo(get_the_content()); ?></p>
							<p class="caughtYouTimeSingle">Submitted <?php the_time('l'); ?> at <?php the_time('g:i a'); ?></p>

						</div>
					



				<?php
				endwhile;
				 else:
				?>
					<p><?php the_author(); ?> has not posted anything.</p>
			<?php
			endif;

			?>
			
			
		</section>
		
	</div>
	

	

			<?php get_footer(); ?>