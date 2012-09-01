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
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script>
	       $(document).ready(function(){
	               	
				$("#sub-menu-<?php echo($parentName); ?> li").fadeIn(600);
				
				$(".bodyContent0").fadeIn();		
				//toggle the body content with the class headExpander
				$("article.columnist h1").click(toggle);
				
				/*http://roshanbh.com.np/2008/03/expandable-collapsible-toggle-pane-jquery.html*/
				$(".glass").hover(showSearch,hideSearch);
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
					//change color of parent category in the nav
					$("li.Lifestyle").addClass("colorChangerLifestyle");
	</script>	



</head>


<body>
	

	<div 
	<?php
	//edits get_post_class, replacing category-featured with ""
	$featuredClasses = get_post_class(); 
	$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);

	$featuredString = implode(' ',$featuredClasses);
	echo("class=\"$featuredString header\">");
	?>
	
	<?php get_header(); ?>

</div>
	


		<!-- This sets the $curauth & $authid variables -->
		<?php
		if(get_query_var('author_name')) :
		$curauth = get_userdatabylogin(get_query_var('author_name'));
		else :
		$curauth = get_userdata(get_query_var('author'));
		endif;
		$authid = $curauth->ID;
		?>

		
		<!-- <div class="profileBox <?php echo($curauth->user_nicename); ?>">
					<h2>About <?php echo $curauth->display_name; ?></h2>

					<p><?php echo $curauth->description; ?></p>
					
					<?php userphoto($wp_query->get_queried_object()) ?>
					
				</div> -->
		<?php
		if (is_category('twogirls')){?>
		       	<div class="columnistHeaderImg"><img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/twogirls.jpg"></div>
		<?php
		}?>	
			<?php
			if (is_category('risdinrome')){?>
			       	<div class="columnistHeaderImg"><img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/risdinrome.jpg"></div>
			<?php
			}?>
		<?php
		if (is_category('mishatownsend')){?>
		       	<div class="columnistHeaderImg"><img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/mishaHeader.jpg"></div>
		<?php
		}?>	
		<?php
		if (is_category('korwinbriggs')){?>
		       	<div class="columnistHeaderImg"><img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/korwinHeader.jpg"></div>
		<?php
		}?>
		<?php
		if (is_category('tylerdibiasio')){?>
		       	<div class="columnistHeaderImg"><img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/tylerHeader.jpg"></div>
		<?php
		}?>
		<?php
		if (is_category('streetwakjers')){?>
		       	<div class="columnistHeaderImg"><img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/streetwalkers.jpg"></div>
		<?php
		}?>
		<?php
		if (is_category('thefinerthings')){?>
		       	<div class="columnistHeaderImg"><img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/thefinerthings.jpg"></div>
		<?php
		}?>
		
		<?php
		if (is_category('twogirls')){?>
		        <div class="adviceWrapper">
		<?php
		}else{?>
			<div class="columnistWrapper">
		<?php
		}
		?>	
		
	<article 	<?php
		//edits get_post_class, replacing category-featured with ""
		$featuredClasses = get_post_class(); 
		$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);

		$featuredString = implode(' ',$featuredClasses);
		echo("class=\"$featuredString columnist\">");
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
	<?php
	if (is_category('twogirls')){?>
	        <div class="advice">
				<p class="adviceInfo">We are <em>Two Girls One Column</em>, RISD's sexiest advice columnists. If you ever find yourself in a shitty situation and need some council, ask us for some girl on girl advice swapping. We are dishing it out, and you are gonna wanna take it, hard.</p>
				<?php echo do_shortcode( '[contact-form 1 "Contact form 1"]' ); ?>
			</div>
	<?php
	}
	?>
	
</div>

</div>


</div>
<?php get_footer(); ?>

