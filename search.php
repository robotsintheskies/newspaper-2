<?php
/*
Template Name: Search Page
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



</head>


<body>
	

	
	<div class="header">

			<?php get_header(); ?>

	</div>
	
		
			
	<div class="searchPage">
		<?php
		$letters = get_cat_ID("Letters");
		$iCaughtYou = get_cat_ID("I Caught You");
		$s = get_query_var('s');
		query_posts("s=$s&cat=-$letters,-$iCaughtYou");
		
		?>
		<?php
			//Regular expression to hide images within posts
			add_filter('the_content','filter',11);
			function filter($content){
		     			$content = preg_replace("/<img.*?>/i","", $content);
						$content = preg_replace("/<object.*?>.*?<\/object.*?>/i","", $content);
						$content = preg_replace("/<div class=\"video_wrap html5video\">.*?<\/script>/i","",$content);
						$content = preg_replace("/<div id=.*?class=\"wp-caption.*?>.*?<\/div>/s","",$content);
						$content = preg_replace("/<div class=\"ngg-galleryoverview.*?<\/div>.*<\/div>/s","",$content);


		   			return $content;
			}?>
		<img src="<?php bloginfo('template_directory'); ?>/images/searchowl.png" />
		<h1>Search results for '<?php echo($s); ?>'</h1>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<div class="searchResultsContainer">
		<?php
		
		if ( have_posts() ) {
			while(have_posts()):
				the_post();
				?>
				<div 
				<?php
				//edits get_post_class, replacing category-featured with ""
				$featuredClasses = get_post_class(); 
				$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);
		
				$featuredString = implode(' ',$featuredClasses);
				echo("class=\"$featuredString searchResult\">");
				?>
					<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
						<a href="<?php the_permalink(); ?>">
				         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
						</a>
					<?php endif; ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="byline">by <em><?php the_author_posts_link(); ?></em></p>
					<?php the_content('Read More >>', FALSE); ?>
				</div>
		
		<?php
		endwhile;
		}else{?>
			
			<p>No search results.</p>
		<?php
		}?>
		</div>
	
	
	<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	       <div id="nav-below" class="navigation">
	         <div class="nav-previous"><?php next_posts_link(  'Older posts <span class="meta-nav">>></span>' ); ?></div>
	         <div class="nav-next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">>></span>'); ?></div>
	       </div><!-- #nav-below -->
	<?php endif; ?>
	
	</div>	
	

		<?php get_footer(); ?>