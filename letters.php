	<div class="category-opinion letters">
		
		
		<?php
		
	
	
		$lettersID = get_cat_id("Letters");
		
		//LOOP
		query_posts(array(
			'cat'=> $lettersID,
			'showposts'=>5
			));
			
		     	
				
		      add_filter('the_content','wpi_read_on_filter',11);
		      function wpi_read_on_filter($content){
					$letterslink = "http://www.all-nighter.com/category/opinion/letters";
					 //Regular expression to direct Read on link to Letters category page
					$content = preg_replace("/(<a href=\")(.*?)(\" class=\"more-link\">)/i","\\1$letterslink\\3",$content);
		         	return $content;
		      }


		
		if (have_posts() ): ?>
			<h4 class="lettersTab">Letters</h4>
		<div class="lettersIndividual">
		<?php
		while(have_posts()):
			the_post();
		?>
			
			<?php the_content('Read More &raquo;', FALSE )?>
			
	
		<?php
		endwhile;?>
		</div>
		<?php
		endif;
		?>
		
	</div>	