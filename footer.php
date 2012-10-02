
<div id="FooterWrapper">
		

		<?php wp_footer();	?>

		<?php

			$menu_string = wp_nav_menu(
					array(
						"menu" =>"secondary_nav",
						"container" => "", 
						"depth" => 0,
						"menu_id" => "secondary_footer_menu",
						"echo" => false)
					);	
					
			// echo($menu_string);
			?>
		
		
	<?php
		
		// $menu_string = wp_nav_menu(
		// 		array(
		// 			"menu" =>"primary_nav",
		// 			"container" => "",
		// 			"depth" => 0,
		// 			"menu_id" => "footer_menu",
		// 			"echo" => false)
		// 		);	
		
		
		// // $category_array = get_categories(
		// // 		array(
		// // 			//root categories = 0
		// // 			"parent" => 0,
		// // 			//Shows empty categories (should probably delete when we go live)
		// // 			"hide_empty" => 0)
		// // 		);
		


		foreach($category_array as $category_obj)
			{
				$category_name = $category_obj->cat_name;
				 echo("**$category_name**");
				//preg_replace is a regular expression. 
				//It finds id="nav-menu-#" in the html code and replaces it with id="Categoryname"
				//The first parameter detects a pattern in the html output, 
				//the second replaces part of the pattern. 
				//    \\# is equal to the hyphened off portions. ex. \\1 = <li id=\"  and \\3 = \".*?\"
				//the third parameter is the variable which holds the resulting string.
	  		$menu_string = preg_replace(
					"/(<li )(class=\")(.*?)(\"><a.*?>$category_name<\/a>)/",
					"\\1\\2$category_name\\4",
					$menu_string
					); 
			}
			
			//Important: echo needs to be placed outside and after the foreach loop
			echo($menu_string);			
	?> 

</div>
</body>

</html>

