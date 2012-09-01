<?php

//SUB CAT NAME

foreach(get_the_category() as $category) : ?>

	<?php 
	//Uses a conditional check to see if the category ID in the $category matches the category ID stored in the $catquery variable
		if( $category->cat_ID == $catquery) { ?>
			<h1 class="categoryName"><?php echo $category->cat_name; ?></h1>
		<?php $categorySlug = $category->slug; ?>
		<?php
	}
	endforeach;	
	?>


<section class="currentStoriesInSubCat">
	<?php


	//LOOP
	query_posts(array(
		'cat'=>$categoryID,
		'category__not_in'=>array($featuredCatID),
		'showposts'=>6
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



				<img src="<?php echo get_post_meta($post->ID, 'top_six_thumb', true); ?>" />	
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="byline">by <em><?php the_author(); ?></em></p>
				<?php the_content('Read More >>', FALSE); ?>

				
				<span class="commentNumber"><a href="<?php the_permalink(); ?>"><?php comments_number('(+)','(1)','(%)'); ?></a></span>
	
					<?php
						endwhile;
					?>

	</section>
	
	<section class="columnists">
		<section class="columnistLink">
		<?php 
		   echo get_avatar( 'acloepfil@g.risd.edu', '96'); 
		   ?>
		<h2><a href="<?php bloginfo('url')?>/author/acloepfil">Adriane Cloepfil</h2>
		</section>	
		<section class="columnistLink">
		<?php 
		   echo get_avatar( 'nwiznitzer@g.risd.edu', '96'); 
		   ?>
		<h2><a href="<?php bloginfo('url')?>/author/nwiznitzer">Nicole Wiznitzer</h2>
		</section>
	</section>	
	