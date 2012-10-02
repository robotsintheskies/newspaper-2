<div class="columnsParentWrapper">
	
	<h1>Columns</h1>
	
	
		<?php
		$risdinrome = get_cat_ID("risdinrome");
		query_posts(array(
			'cat'=>$risdinrome,
			'showposts'=>3
		));?>


		<?php
		if(have_posts()):?>
		<p class="columnistLabel"><a href="<?php bloginfo('url')?>/category/risdinrome">RISD in Rome</a></p>
		<?php
		while(have_posts()):
			the_post();?>
			<div class="columnsParentIndividual">
				<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
					<a href="<?php bloginfo('url')?>/category/risdinrome">
			         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
					</a>
				<?php endif; ?>
				<h2><a href="<?php bloginfo('url')?>/category/risdinrome"><?php the_title(); ?></a></h2>
				 <?php
							      $string = get_the_content_our_way('Read More >>', FALSE);
							               echo($string);
							      ?> 		
			</div>
		<?php
		endwhile;
		endif;
		?>
		
		<div class="clear"></div>
		
		
		<?php
		$thefinerthings = get_cat_ID("thefinerthings");
		query_posts(array(
			'cat'=>$thefinerthings,
			'showposts'=>3
		));?>

		
		
		<?php
		if(have_posts()):?>
		<p class="columnistLabel"><a href="<?php bloginfo('url')?>/category/thefinerthings">The Finer Things</a></p>
		<?php
		while(have_posts()):
			the_post();?>
			<div class="columnsParentIndividual">
				<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
					<a href="<?php bloginfo('url')?>/category/thefinerthings">
			         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
					</a>
				<?php endif; ?>
				<h2><a href="<?php bloginfo('url')?>/category/thefinerthings"><?php the_title(); ?></a></h2>
				 <?php
							      $string = get_the_content_our_way('Read More >>', FALSE);
							               echo($string);
							      ?> 		
			</div>
		<?php
		endwhile;
		endif;
		?>
		
		<div class="clear"></div>
		
		
		
		
		<?php
		$misha = get_cat_ID("mishatownsend");
		query_posts(array(
			'cat'=>$misha,
			'showposts'=>3
		));?>
		<?php
		//Regular expression to hide images within posts
		add_filter('the_content','parentColumnists_image',11);
		function parentColumnists_image($content){
	     			$content = preg_replace("/<img.*?>/i","", $content);
					$content = preg_replace("/<object.*?>.*?<\/object.*?>/i","", $content);
					$content = preg_replace("/<div class=\"video_wrap html5video\">.*?<\/script>/i","",$content);
					$content = preg_replace("/<div id=.*?class=\"wp-caption.*?>.*?<\/div>/s","",$content);


	   			return $content;
		}?>
		
		
		<?php
		if(have_posts()):?>
		<p class="columnistLabel"><a href="<?php bloginfo('url')?>/category/mishatownsend">Misha Townsend - The Starving Artist</a></p>
		<?php
		while(have_posts()):
			the_post();?>
			<div class="columnsParentIndividual">
				<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
					<a href="<?php bloginfo('url')?>/category/mishatownsend">
			         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
					</a>
				<?php endif; ?>
				<h2><a href="<?php bloginfo('url')?>/category/mishatownsend"><?php the_title(); ?></a></h2>
				 <?php
							      $string = get_the_content_our_way('Read More >>', FALSE);
							               echo($string);
							      ?> 		
			</div>
		<?php
		endwhile;
		endif;
		?>
		
		<div class="clear"></div>
			<?php
			$korwin = get_cat_ID("korwinbriggs");
			query_posts(array(
				'cat'=>$korwin,
				'showposts'=>3
			));?>


			<?php
			if(have_posts()):?>
			<p class="columnistLabel"><a href="<?php bloginfo('url')?>/category/korwinbriggs">Korwin Briggs - Wait! I can explain!</a></p>
			<?php
			while(have_posts()):
				the_post();?>
				<div class="columnsParentIndividual">
					<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
						<a href="<?php bloginfo('url')?>/category/korwinbriggs">
				         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
						</a>
					<?php endif; ?>
					<h2><a href="<?php bloginfo('url')?>/category/korwinbriggs"><?php the_title(); ?></a></h2>
					 <?php
								      $string = get_the_content_our_way('Read More >>', FALSE);
								               echo($string);
								      ?> 		
				</div>
			<?php
			endwhile;
			endif;
			?>
			
			<div class="clear"></div>


				<?php
				$tyler = get_cat_ID("tylerdibiasio");
				query_posts(array(
					'cat'=>$tyler,
					'showposts'=>3
				));?>


				<?php
				if(have_posts()):?>
				<p class="columnistLabel"><a href="<?php bloginfo('url')?>/category/tylerdibiasio">Tyler DiBiasio</a></p>
				<?php
				while(have_posts()):
					the_post();?>
					<div class="columnsParentIndividual">
						<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
							<a href="<?php bloginfo('url')?>/category/tylerdibiasio">
					         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
							</a>
						<?php endif; ?>
						<h2><a href="<?php bloginfo('url')?>/category/tylerdibiasio"><?php the_title(); ?></a></h2>
						 <?php
									      $string = get_the_content_our_way('Read More >>', FALSE);
									               echo($string);
									      ?> 		
					</div>
				<?php
				endwhile;
				endif;
				?>	
				
				
				<div class="clear"></div>

				
					

						<?php
						$twogirls = get_cat_ID("twogirls");
						query_posts(array(
							'cat'=>$twogirls,
							'showposts'=>3
						));?>


						<?php
						if(have_posts()):?>
						<p class="columnistLabel"><a href="<?php bloginfo('url')?>/category/twogirls">Two Girls, One Column</a></p>
						<?php
						while(have_posts()):
							the_post();?>
							<div class="columnsParentIndividual">
								<?php if(get_post_meta($post->ID, 'thumbnail', true)):?>
									<a href="<?php bloginfo('url')?>/category/twogirls">
							         <img src="<?php echo get_post_meta($post->ID, 'thumbnail', true); ?>" />
									</a>
								<?php endif; ?>
								<h2><a href="<?php bloginfo('url')?>/category/twogirls"><?php the_title(); ?></a></h2>
								 <?php
											      $string = get_the_content_our_way('Read More >>', FALSE);
											               echo($string);
											      ?> 		
							</div>
						<?php
						endwhile;
						endif;
						?>	
		
		
	
	
</div>	