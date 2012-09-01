<?php /*
Example template
Author: mitcho (Michael Yoshitaka Erlewine)
*/ 
?><h3>Related Posts</h3>
<?php if ($related_query->have_posts()):?>
<ol 
	<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
	<li 	<?php

				$featuredClasses = get_post_class(); 
				$featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);
				//array_splice($featuredClasses, "/category-featured/",' ');
				$featuredString = implode(' ',$featuredClasses);
				echo("class=\"$featuredString\">");



			?><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><!-- (<?php the_score(); ?>)--></li>
	<?php endwhile; ?>
</ol>
<?php else: ?>
<p>No posts to be found.</p>
<?php endif; ?>