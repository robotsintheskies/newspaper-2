<?php if($is_opinion){
	?>

	<!-- <div class="columnists category-opinion">
			<h2>Staff Columnists</h2>
			<?php
			query_posts(array(
				'author_name'=>'acloepfil',
				'showposts'=>1
				));
			if(have_posts()):?>
			<?php
			while(have_posts()):
				the_post();?>
				<div class="columnistLink">
					<?php echo get_avatar( 'acloepfil@g.risd.edu', '50'); ?>
					<h3><a href="<?php bloginfo('url')?>/author/acloepfil">Adriane Cloepfil</a></h3>
					<p><a href="<?php bloginfo('url')?>/author/acloepfil"><?php the_title(); ?></a></p>
				</div>
			<?php
			endwhile;
			?>
			<?php
			query_posts(array(
				'author_name'=>'nwiznitzer',
				'showposts'=>1
			));
			while(have_posts()):
				the_post();?>
				<div class="columnistLink">
					<?php echo get_avatar( 'nwiznitzer@g.risd.edu', '50'); ?>
					<h3><a href="<?php bloginfo('url')?>/author/nwiznitzer">Nicole Wiznitzer</a></h3>
					<p><a href="<?php bloginfo('url')?>/author/nwiznitzer"><?php the_title(); ?></a></p>
				</div>
			<?php
			endwhile;
			endif;
			?>
		</div> -->
<?php
}
elseif($is_lifestyle){?>
	<div class="columnists category-lifestyle">
		<h2><a href="<?php bloginfo('url')?>/category/lifestyle/columns-lifestyle">Columnists</a></h2>
		<?php
		$misha = get_cat_ID("mishatownsend");
		query_posts(array(
			'cat'=>$misha,
			'showposts'=>1
			));
		if(have_posts()):?>
		<?php
		while(have_posts()):
			the_post();?>
			<div class="columnistLink">
				<?php echo get_avatar( 'mtownsen01@g.risd.edu', '50'); ?>
				<h3><a href="<?php bloginfo('url')?>/category/mishatownsend">Misha Townsend</a></h3>
				<p><a href="<?php bloginfo('url')?>/category/mishatownsend">The Starving Artist</a></p>
			</div>
		<?php
		endwhile;
		?>
		<?php
		$tyler = get_cat_ID("tylerdibiasio");
		query_posts(array(
			'cat'=>$tyler,
			'showposts'=>1
		));
		while(have_posts()):
			the_post();?>
			<div class="columnistLink">
				<?php echo get_avatar( 'tdibiasi@g.risd.edu', '50'); ?>
				<h3><a href="<?php bloginfo('url')?>/category/tylerdibiasio">Tyler DiBiasio</a></h3>
				<p><a href="<?php bloginfo('url')?>/category/tylerdibiasio">Inside the Critic's Bathroom</a></p>
			</div>
		<?php
		endwhile;
		endif;
		?>
		<?php
		$korwin = get_cat_ID("korwinbriggs");
		query_posts(array(
			'cat'=>$korwin,
			'showposts'=>1
		));
		while(have_posts()):
			the_post();?>
			<div class="columnistLink">
				<?php echo get_avatar( 'kbriggs@g.risd.edu', '50'); ?>
				<h3><a href="<?php bloginfo('url')?>/category/korwinbriggs">Korwin Briggs</a></h3>
				<p><a href="<?php bloginfo('url')?>/category/korwinbriggs">Wait! I can explain!</a></p>
			</div>
		<?php
		endwhile;
		?>
		<?php
		query_posts(array(
			'author_name'=>'vlamantia',
			'showposts'=>1
		));
		while(have_posts()):
			the_post();?>
			<div class="columnistLink">
				<?php echo get_avatar( 'vlamanti@g.risd.edu', '50'); ?>
				<h3><a href="<?php bloginfo('url')?>/author/vlamantia">Victoria LaMantia</a></h3>
				<p><a href="<?php bloginfo('url')?>/author/vlamantia">Live a Healthy Lifestyle</a></p>
			</div>
		<?php
		endwhile;
		?>
		<?php
		$twogirls = get_cat_ID("twogirls");
		query_posts(array(
			'cat'=>$twogirls,
			'showposts'=>1
		));
		while(have_posts()):
			the_post();?>
			<div class="columnistLink">
				<?php echo get_avatar( 'advice@all-nighter.com', '50'); ?>
				<h3><a href="<?php bloginfo('url')?>/category/twogirls">Two Girls One Column</a></h3>
				<p><a href="<?php bloginfo('url')?>/category/twogirls">Shootin' the shit
				and all the verbal diarrhea you can handle</a></p>
			</div>
		<?php
		endwhile;
		?>
		<div class="columnistsClear"></div>
	</div>

<?php	
}
?>