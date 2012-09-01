<!DOCTYPE html>

<html>

<head>
   
   <title><?php bloginfo("Newspaper"); ?><?php wp_title(); ?></title>
   <meta charset="<?php bloginfo('charset'); ?>" />
   <meta name="generator" content="Wordpress <?php bloginfo('version'); ?>" />
   <meta name="description" content="<?php bloginfo('description'); ?>">
   <link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />
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
               $categoryParentSlug = "sub$parentName";
                $childName = $category->name;
                     $childLink = get_category_link($childCatID);
               
               break;
         }
            
            
         
   ?>
   
      
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
   <script>
          $(document).ready(function(){
                     
            $("#sub-menu-<?php echo($parentName); ?> li").fadeIn(600);
                  
            $(".glass").hover(showSearch,hideSearch);   
          });
   
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


</head>


<body>
   

   
   <div class="header <?php echo($categoryParentSlug); ?>">

         <?php get_header(); ?>

   </div>
   
 
      <?php
          
         if(have_posts()) :
            while(have_posts()):
               the_post();
               
      ?>
        <?php
		$lectureReviews = get_cat_ID("Lecture Reviews");
		$galleryReviews = get_cat_ID("Gallery Reviews");
		$beyondRISD = get_cat_ID("Beyond RISD");
		$featuredInspiration = get_cat_ID("Featured Inspiration")
		?>
		<div class="imageGalleryContainer">
			<div class="imageGallery">
			<div class="prevGalleryLink"><?php next_post_link('%link', 'Previous', TRUE ); ?></div>
      		<?php the_content(); ?>
			<div class="nextGalleryLink"><?php previous_post_link('%link', 'Next', TRUE ); ?></div>
 			</div>
		</div>
      <?php endwhile; ?>
   
      <?php endif; ?>
      

      <div class="wrapper">
      <div id="comments_template">
         <?php comments_template(); ?>
      </div>
      
      
	</div>
   
   
   

   
   

         <?php get_footer(); ?>
