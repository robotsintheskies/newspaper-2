<div class="spacer"></div>


<div id="footer">
	
	<!-- <img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/excuse.png" class="excuse"/> -->
	
	<!-- <li>
		<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><img src="http://www.mozilla.org/images/feed-icon-14x14.png" alt="RSS Feed" title="RSS Feed" /></a> 
		</li>

		<li>
		<a href="<?php bloginfo('atom_url'); ?>" title="<?php _e('Syndicate this site using Atom'); ?>"><?php _e('Atom'); ?></a>
		</li>

		<li> 
		<a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>
		</li> -->
	<img src="<?php bloginfo('url') ?>/wp-content/themes/newspaper/images/RISDlogo.png" class="logoFooter"/>
<div class="footer_wrapper">
	<p class="rssButton">Subscribe by: <a href="<?php bloginfo('url') ?>/subscribe" />E-mail</a> / <a href="http://feeds.feedburner.com/All-nighter" title="<?php _e('Syndicate this site using RSS'); ?>" />RSS</a> </p>
	<nav class="secondary_nav">
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
					
			echo($menu_string);
			?>
		
		
	</nav>	
	
	
	
	
<nav class="footer_nav">
	<?php wp_footer();	?>
	<?php
		
		$menu_string = wp_nav_menu(
				array(
					"menu" =>"primary_nav",
					"container" => "",
					"depth" => 0,
					"menu_id" => "footer_menu",
					"echo" => false)
				);	
		
		
		$category_array = get_categories(
				array(
					//root categories = 0
					"parent" => 0,
					//Shows empty categories (should probably delete when we go live)
					"hide_empty" => 0)
				);
			
		foreach($category_array as $category_obj)
			{
				$category_name = $category_obj->cat_name;
				// echo("**$category_name**");
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
</nav>

	


</div>

</div>
</body>

</html>

