<?php get_header(); ?>

<?php
	if(have_posts()):
		while(have_posts()): the_post();
?>
<div class="cache-dot"></div>
<?php if(has_post_thumbnail()): ?>
<?php
$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->id),'full-screen');
$url = $thumb[0];
?>
<div id="background-image" style="background-image:url(<?php echo $url; ?>);"></div>
<?php else: ?>
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
<?php endif; ?>

	<div class="container-1400">
		<div class="single-actu">
			<h1 class="standard"><?php the_title(); ?></h1>
			<div class="left">
				<div class="content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php
		endwhile;
	endif;
?>
<?php get_footer(); ?>