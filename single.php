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
      
   <article <?php 
      //avoids styling confusion with front page by removing the class category-featured
      //unshift adds the class single
      $featuredClasses = get_post_class(); 
      $featuredClasses = preg_replace("/category-featured/",'',$featuredClasses);
      //array_splice($featuredClasses, "/category-featured/",' ');
      array_unshift($featuredClasses, "single");
      $featuredString = implode(' ',$featuredClasses);
      echo("class=\"$featuredString\">");
   
       
   
   ?>
      <?php
          
         if(have_posts()) :
            while(have_posts()):
               the_post();
               
      ?>
      <h1><?php the_title(); ?></h1>
     <?php
	
	if(! in_category(array('We Recommend','Comics'))) {?>
 	<p class="bylineSingle"><em>
		<?php
      risd_coauthors_posts_links('Written by ',', Images by ');
   ?>
	    
		| Date posted: <?php the_date(); ?>
	</em>
	</p>
	<?php
	}
	
	if( in_category('Comics')){?>
		<p class="bylineSingle"><em>
		by <?php the_author(); ?>
		| Date posted: <?php the_date(); ?>
		</em></p>
	<?php
	}
	?>	
		
      
      <?php the_content(); ?>

<?php
	if(! in_category('We Recommend')) {?>
      <p class="metaSingle">
      <?php 
         $categories = get_the_category();      // get an array of category objects

               foreach ($categories as $category) { 
                       if (preg_match('/feature/i',$category->name)) {
                            continue; 
                         }
                         if ($category->parent == 0) {
                            continue; 
                         }

                        $parentCatID = $category->parent;
                        $parentName = get_cat_name($parentCatID);
                        $parentLink = get_category_link($parentCatID);
                        $childCatID = $category->cat_ID;
                        $childName = $category->name;
                        $childLink = get_category_link($childCatID);

                        break;
               }      
                      echo("Posted in <a href=$parentLink>$parentName</a> | <a href=$childLink>$childName</a>"); 
                    $posttags = get_the_tags();
                    $num_tags = count($posttags);
                    $index = 0;
                    if($posttags){  ?>
                     Tagged in: 
                  <?php foreach($posttags as $tag){
                         $index++; ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>">
                        <?php echo($tag->name . ' ');?>
                     </a>
      
            <?php
				 
                   if ($index < $num_tags) {
                      echo(" | ");
                   }
            }
            }

            ?>
         </p>
		<?php
	}
		?>
 
      <?php endwhile; ?>
   
      <?php endif; ?>
      
      
      <div id="comments_template">
         <?php comments_template(); ?>
      </div>
      
      
   </article>
   
   
   



   </div>
   
   <?php
	if(! in_category(array('We Recommend','Comics'))) {?>
<?php get_sidebar(); ?>
<?php
}
?>
         <?php get_footer(); ?>
<?php
}
?>
  
