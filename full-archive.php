<?php

/*
Template Name: Full Archives
*/
?>

<html>
<head>

	<title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
	<link rel="shortcut icon" href="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/favicon.ico">

	<?php wp_head(); ?>
</head>

<body>
<?php get_header();?>

<div id="FullArchiveContainer">
	<div id="FullArchiveContent" role="main">

		<?php the_post(); ?>



		<!--The Title of the Page Entry-->
		<div id="FullArchiveHeader"><div id="FullArchiveEntry"><h5 class="entry-title"><?php the_title(); ?></h5></div><?php get_search_form(); ?></div>


		<div id="FullArchiveBoxes">
		<ul>

			<?php wp_get_archives('type=monthly'); ?>
		</ul>

	</div>
		

	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
