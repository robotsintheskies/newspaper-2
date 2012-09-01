<?php /*
EXAMPLE TEMPLATE
AUTHOR: MITCHO (MICHAEL YOSHITAKA ERLEWINE)
*/
?>
<?php if ($related_query->have_posts()):?>
 
<h2 class="widgettitle">Other Interesting Posts</h2>
<ul>
    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
        <li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><!-- (<?php the_score(); ?>)--></li>
    <?php endwhile; ?>
</ul>
<?php endif; ?>

 
 
