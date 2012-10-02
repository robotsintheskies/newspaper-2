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
   
   	<?php 
			//Use get_query_var to get the current category
			//Use get_category and then extract information (ID, Name, etc.)
			$catquery = get_query_var('cat');
			$category = get_category($catquery);
			$categoryName = $category->name;
	?>
   
   <style type="text/css">
      
   
   </style>
   
   
   <?php wp_head(); ?>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
   <script>
   $(document).ready(function(){
            //change color of parent category in the nav
			$("li<?php echo(".$categoryName"); ?>").addClass("colorChanger<?php echo($categoryName)?>");   
      var found_shown = 0;
      $("div.events ul li").each( function() {
         if (found_shown == 3) {
            return;
         }
         if ($('p:first',this).hasClass('date_show')) {
            found_shown++;
            if (found_shown == 3) {
               return;
            }
         }
         $('ul',this).slideToggle(100);
         });

      $('p.date_show').click(toggle);
		$(".glass").hover(showSearch,hideSearch);
		
		
   });



   function toggle(){
      var stop = 0;
      $(this).next().slideToggle(100);  // Works partially
      $(this).parent().    // gives us the top <li> for this event
             nextAll('li'). // all the following top event <li>'s
             each( function () {
                if (stop) {
                   return;
                }
                if ($('p',this).hasClass('date_hide')) {
                   $('ul',this).slideToggle(100);
                }
                else {
                   stop = 1;
                }
             });
   };
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
   

   
   <div class="header category-events">

         <?php get_header(); ?>

   </div>
   
   <div class="wrapper">
	<div class="eventsKey">
         <h2 class="categoriesKey">Categories</h2>
         <ul>
            <li class="keyStudentEvents">Student Events</li>
			<li class="keyProvidenceEvents">Providence Events</li>
            <li class="keyLectures">Lectures</li>
            <li class="keyGalleryOpenings">Gallery Openings</li>
            <li class="keyFilmScreenings">Film Screenings</li>
			<li class="keyHealthAndWellness">Health &amp; Wellness</li>
			<li class="keyCareerDevelopment">Career Services</li>
			<li class="keySpecialEvents">Special Events</li>
			
         <ul>   
      </div>

      <?php
	if ( have_posts() ) {
      while(have_posts()):
         the_post();
         ?>
            
         
            
            <?php the_content(); ?>
            
   
   
      <?php
      endwhile;
	}else{
      ?>
		We can't think of anything. : ( 
	<?php } ?>


	
		<?php
	
		$weSuggest = new WP_Query();
		$weSuggest->query(
			array(
				'category_name' => 'werecommend',
				'showposts' => 5
			));
			if($weSuggest->have_posts()):?>
			<div class="weSuggest">
				<h2 class="weSuggest">We Suggest</h2>
			<?php
			while(
				$weSuggest->have_posts()) : 
				$weSuggest->the_post();
				$wp_query->in_the_loop = true;
		?>
		<div class="weSuggestIndividual">
			 <?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
		         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
		      <?php endif; ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="eventDetailsIndividual"><?php echo get_post_meta($post->ID, 'event_details', true); ?></p>
		<?php the_content('Read More >>', FALSE); ?>
		</div>
		<?php
		endwhile;
		endif;
		?>
	</div>
   
  
   </div>


   

      <?php get_footer(); ?>
