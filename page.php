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
	<?php
	if(have_posts()) :
		while(have_posts()): the_post();
	?>
		<h1 class="standard"><?php the_title(); ?></h1>
		<div class="container-form">
			<?php the_content(); ?>
		</div>

	<?php
	endwhile;
	endif;
	?>
</div>
<?php get_footer(); ?>