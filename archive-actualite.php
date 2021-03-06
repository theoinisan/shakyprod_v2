<?php get_header(); ?>
<div id="home-video">
	<div class="cache-dot"></div>
	<?php
	$video = get_field('fichier_video','option');
	if($video):
		$poster = get_field('poster_video','option');
		if(!empty($poster)):
			$alt = $poster['alt'];
			$size = 'full-screen';
			$thumb = $poster['sizes'][$size];
		?>
		<div id="background-mobile" style="background-image:url(<?php echo $thumb; ?>);"></div>
		<video id="background-video" autoplay loop poster="<?php echo $thumb; ?>">
			<source src="<?php echo $video['url']; ?>" type="video/mp4">
		</video>
		<?php endif; ?>
	<?php endif; ?>
</div>
<div class="container-1400">
	<h1 class="standard">Actualités</h1>
	<?php
	if(have_posts()):
	while(have_posts()): the_post();
	?>
	<div class="actualite">
		<a href="<?php the_permalink(); ?>">
			<div class="thumbnail">
				<?php the_post_thumbnail('bloc-accueil'); ?>
			</div>
			<div class="content">
				<div class="container">
					<p>Publié le : <?php echo get_the_date(); ?></p>
					<h2><?php the_title(); ?></h2>
					<p><?php the_excerpt(); ?></p>
					<span>Voir plus...</span>
				</div>
			</div>
		</a>
	</div>
	<?php
	endwhile;
	endif;
	?>
</div>
<?php get_footer(); ?>