<!DOCTYPE html>
<html>

<head>
   
   <title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
   <meta charset="<?php bloginfo('charset'); ?>" />
   <meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
   <meta name="description" content="<?php bloginfo('description'); ?>">
   <link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('url') ?>/wp-content/themes/newspaper/jquery.simplyscroll-1.0.4.css" media="all" 
	type="text/css">
	<link rel="shortcut icon" href="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/favicon.ico">
	<!--Type Kit-->
	<script type="text/javascript" src="http://use.typekit.com/ojk4cnw.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	
 
<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.4/full/jquery.tools.min.js"></script>
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

   <script type="text/javascript">
   //var $j = jQuery.noConflict();

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
		       
		         }
		         else {
		            timer = setTimeout("timesUp()",3000);
		         }
		      }
      
      </script>
	
	<?php wp_head(); ?> 
	
   </head>
   <body>
	<!--[if lt IE 9]>
	<h1>Please upgrade to IE 9.</a></h1>
	<![endif]-->

	
<div class="header category-inspiration">
      
      <?php get_header(); ?>
   
</div>

<div class="wrapper">
	
	<object width="924" height="555"><param name="movie" value="http://www.youtube.com/v/M_J5E4dhcVA?fs=1&amp;hl=en_US"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/M_J5E4dhcVA?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="924" height="555"></embed></object>
	<div class="left">
		<div class="submissions">
			<h1>Submissions</h1>
	<?php
	if(have_posts()):
		while(have_posts()):
		the_post();
	?>
	<div class="individualsubmission">
		<a href="<?php the_permalink(); ?>"><img src="http://img.youtube.com/vi/<?php echo get_post_meta($post->ID, 'TDOMF Form #3 Custom Field #_2', true)?>/1.jpg" style="width: 150px;"/></a>
		<p><strong><?php echo(get_post_meta($post->ID, 'TDOMF Form #3 Custom Field #_4', true)) ?></strong></p>
		<p>by <?php echo(get_post_meta($post->ID, 'TDOMF Form #3 Custom Field #_3', true)) ?></p>
	</div>	
	<?php endwhile; 
	endif; ?>
	</div>
	<div class="clear"></div>
	<div class="submityourown">	
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('freshmenQuestion') ) : ?>
         	<?php endif; ?>
	</div>	
	</div>
	
	<div class="right">
		<h2>Vote on your favorite</h2>
		<p>Polls open next Thursday.</p>
	</div>	
</div>	

<?php get_footer(); ?>