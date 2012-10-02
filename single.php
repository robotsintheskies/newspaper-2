<?php
if(in_category("Student Gallery")){
	include (TEMPLATEPATH . '/single-gallery.php');
}
if(in_category("Freshmen Question")){
	include (TEMPLATEPATH . '/freshmen-question.php');
}
else{
?>

<!DOCTYPE html>

<html>

<head>
   
   <title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
   <meta charset="<?php bloginfo('charset'); ?>" />
   <meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
   <meta name="description" content="<?php bloginfo('description'); ?>">
   <link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/favicon.ico">
 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
 <script src="/galleria/galleria-1.2.8.min.js"></script>
  <script src="http://localhost/all-nighter/wp-content/themes/newspaper-2/galleria/galleria-1.2.8.min.js"></script>
  <script src="http://localhost/all-nighter/wp-content/themes/newspaper-2/galleria/themes/classic/galleria.classic.js"></script>

 <script>
            Galleria.loadTheme('http://localhost/all-nighter/wp-content/themes/newspaper-2/galleria/themes/classic/galleria.classic.js');
            Galleria.run('#galleria');
</script>


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
               $categoryParentSlug = "sub$parentName";
                $childName = $category->name;
                     $childLink = get_category_link($childCatID);
               
               break;
         }   
   ?>
    
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
 
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
   

   
   <div class="header <?php echo($categoryParentSlug); ?>">

         <?php get_header(); ?>

   </div>
   
   <div class="wrapper">
      
   <article>
      <?php   
         if(have_posts()) :
            while(have_posts()):
               the_post();      
      ?>
    
      <div id='hero' style='background-image: url("<?php echo get_post_meta($post->ID, 'thumbnail', true);?>"); background-repeat: repeat; width:100%; height: 400px;'>
   		  <div id='title'><h1><?php the_title(); ?></h1></div>
	 </div> 	  
   
   	<div id="articleauthor">
	<h3> <?php risd_coauthors_posts_links('by ',', Images by ');?> on <?php the_time('m/d/y'); ?> 
  </h3></div>

	 <div id='posted'>
      <?php the_content(); ?>
     </div>
 
      <?php endwhile; ?>
   
      <?php endif; ?>
      
      <hr id='bottom-rule'>
      <div id="comments_template">
         <?php comments_template(); ?>
      </div>
      
      
   </article>
   
   
   



   </div>
   
   
         <?php get_footer(); ?>
<?php
}
?>