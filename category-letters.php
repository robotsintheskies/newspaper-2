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
	<style type="text/css">
			article.lettersIndividual div{
			   overflow: hidden;
			   }
			p.switcher{
				cursor: pointer;
				display: none;
			}
	</style>
	
	
	<?php wp_head(); ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
	               	
				$("#sub-menu-<?php echo($parentName); ?> li").fadeIn(600);
				
				$(".bodyContent0").fadeIn();		
				//toggle the body content with the class headExpander
				$("article.columnist h1").click(toggle);
				
				/*http://roshanbh.com.np/2008/03/expandable-collapsible-toggle-pane-jquery.html*/
				$(".glass").hover(showSearch,hideSearch);
				
				//change color of parent category in the nav
				$("li.Opinion").addClass("colorChangerOpinion");
	       });
	
			function toggle(){
				var className = $(this).attr("class");
				var postNumber = className.substr(2);
				$(".bodyContent" + postNumber).slideToggle(100);
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
	

	
	<div <?php post_class("header"); ?>>

			<?php get_header(); ?>

	</div>
	
	
	<div class="lettersWrapper">
	<article 	<?php
		//edits get_post_class, replacing category-featured with ""
		$featuredClasses = get_post_class(); 
		$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);

		$featuredString = implode(' ',$featuredClasses);
		echo("class=\"$featuredString lettersColumn\">");
		?>
		<?php 
		$index=0;
		if( have_posts()) :
			while( have_posts()) :
				the_post();
				
				global $more;    // Declare global $more (before the loop).
				$more = 1;       // Set (inside the loop) to display all content, including text below more.
				?>
				
				<h1 class="s_<?php echo($index) ?>"><?php the_title(); ?></h1>
				
				<div class="bodyContent<?php echo($index) ?>">
					<p class="bylineSingle"><em>
						<?php
				      risd_coauthors_posts_links('Written by ',', Images by ');
				   ?>

						| Date posted: <?php the_date(); ?>
					</em>
					</p>
				<?php the_content(); ?>
				<div id="comments">
					<p class="commentNumber"><a href="<?php the_permalink(); ?>"><?php comments_number('0','1','%'); ?> Comments</a></p>  <p class="addComment"><a href="<?php the_permalink(); ?>">Add a Comment</a></p>
				</div>	
				</div>
				
				
				
			<?php
			$index ++;
			endwhile;
			 else:
			?>
				<p><?php the_author(); ?> has not posted anything.</p>
		<?php
		endif;
		
		?>
	</article>

	<div class="callForLetters">
		<h2>Contact Us</h2>
		<p>We'd love to hear from you! Send us your questions, comments or concerns at letters@all-nighter.com.</p>
	</div>	

	</div>
		<?php get_footer(); ?>