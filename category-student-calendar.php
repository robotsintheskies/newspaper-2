<!DOCTYPE html>

<html>

<head>
	
	<title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
	<link rel="shortcut icon" href="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/favicon.ico">
	
	
	
	<style type="text/css">
	
	
	</style>
	
	
	<?php wp_head(); ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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
	       })
	</script>


</head>


<body>
	

	
	<header class="header category-<?php echo($categorySlug); ?>">

			<?php get_header(); ?>

	</header>
	
	
	<!--http://wpgarage.com/plugins/wordpress-calendar-plugins/-->

	
	

	<div id="footer">

		<?php get_footer(); ?>
