<?php
/**
 * Template Name: Devis et Contact
 *
 */
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