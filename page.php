<?php
get_header();
?>
<div id="home-video">
	<div class="cache-dot"></div>
	<?php
	$video = get_field('fichier_video','option');
	if($video):
	?>
		<video id="background-video" autoplay loop>
			<source src="<?php echo $video['url']; ?>" type="video/mp4">
		</video>
	<?php endif; ?>
</div>
<div class="container-1400">
	<?php
	if(have_posts()) :
		while(have_posts()): the_post();
	?>
		<h1 class="archive"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	<?php
	endwhile;
	endif;
	?>
</div>
<?php get_footer(); ?>