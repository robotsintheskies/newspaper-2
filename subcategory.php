<!--Default Subcategory Page-->

<?php
if($categoryName == "Columns"){?>
	<?php include (TEMPLATEPATH . '/columnsParent.php'); ?>
<?php
}else{
	?>
<div class="wrapperSubCat">
<?php

//SUB CAT NAME

foreach(get_the_category() as $category) : ?>

	<?php 
	//Uses a conditional check to see if the category ID in the $category matches the category ID stored in the $catquery variable
	$catParentID = $category->parent;
	$catParentName = get_cat_name($catParentID);
		if( $category->cat_ID == $catquery) { ?>
			<h1 class="categoryName <?php echo("sub$catParentName")?>"><?php echo $category->cat_name; ?></h1>
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
			<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
					<a href="<?php the_permalink(); ?>">
			         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" style="width:198px;"/>
					</a>
			<?php endif; ?>
			
			<?php
			$authorNicename = get_the_author_meta('user_nicename');
			$opinionID = get_cat_ID("Opinion");
			$lifestyleID = get_cat_ID("Lifestyle");
			if (in_category(array('Opinions','Staff Columns','Lifestyle','Columns'))) { ?>
				<h2><a href="<?php bloginfo('url')?>/author/<?php echo($authorNicename)?>"><?php the_title(); ?></a></h2>
				

			<?php
		     }else{?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php
			}?>
				<p class="byline">by <em><?php the_author_posts_link(); ?></em></p>
				<?php
				$string = get_the_content_our_way('Read More >>', FALSE);
			          echo($string);
			?>

			
			</div>
					<?php
						endwhile;
					?>




	</section>

	<?php
	if ($category->parent == $opinionID || $category->parent == $lifestyleID) { ?>
		
				
			<?php include (TEMPLATEPATH . '/columnsAdvert.php'); ?>
		
		            
	<?php
     }
	?>
</div>

<?php
}
?>