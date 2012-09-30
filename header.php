<?php

// The Query
$iCaughtYou = get_cat_ID("I Caught You");
$the_query = new WP_Query();
$the_query->query(
      array(
         'cat' => -$iCaughtYou,
         'posts_per_page' => 1
      ));
// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

<div id= "header">

  		<div id= "blog-title">
  			<div id= "title-rule"></div> 
  		      <!-- <br> -->
    			 <a id= "home" href="index.php">http://www.all-nighter.com</a>
    			 <p id= "issue">our last update: </p>
    			 <h2 id= 'date'><?php the_date('m/d/y'); ?><h2> 
  			
  		</div>

	
	
<?php
	
endwhile;

// Reset Post Data
wp_reset_postdata();

?>



<div class="nav">

 <?php
      
      $menu_string = wp_nav_menu(
            array(
               "menu" =>"primary_nav",
               "container" => "",
               "depth" => 0,
               "menu_id" => "menu",
               "echo" => false)
            );   
      
      
      $category_array = get_categories(
            array(
               //root categories = 0
               "parent" => 0,
               //Shows empty categories (should probably delete when we go live)
                "hide_empty" => 1
				)
            );
         
      foreach($category_array as $category_obj) {
			$category_name = $category_obj->cat_name;
            if (has_children_cat($category_obj->cat_ID)) {
               //adds id=sub-menu-$category_name
               $menu_string = preg_replace(
                             "/(<a.*?>$category_name<\/a>.*?<ul )(class=\".*?\")/s",
                             "\\1id=\"sub-menu-$category_name\" \\2",
                             $menu_string
                             );
            }
            
            //It finds id="nav-menu-#" in the html code and replaces it with id="Categoryname"
            //The first parameter detects a pattern in the html output, 
            //the second replaces part of the pattern. 
            # is equal to the hyphened off portions. ex. \\1 = <li id=\"  and \\3 = \".*?\"
            //the third parameter is the variable which holds the resulting string.
            $menu_string = preg_replace(
               "/(<li )(id=\".*?\") (class=\")(.*?)(\"><a.*?>$category_name<\/a>)/",
               "\\1\\3$category_name\\5",
               $menu_string
               );
         }
         
         //Important: echo needs to be placed outside and after the foreach loop
         echo($menu_string);   ?>   
</div>   

</div>


