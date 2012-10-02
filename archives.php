<?php
/*
Template Name: Archives
*/
?>
<html>

<head>
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<title>Archives</title>



	<?php wp_head(); ?>

</head>

<body>
<?php get_header(); ?>

<div id="ArchiveContainer">
	<div id="ArchiveContent" role="main">

		<?php the_post(); ?>

		<!--The Title of the Page Entry-->
		<h5 class="entry-title"><?php the_title(); ?></h5>


		
		<?php get_search_form(); ?>
		
		
		<ul>
			<?php wp_get_archives('type=monthly&limit=6&show_post_count=0'); ?>
		</ul>
		

	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
