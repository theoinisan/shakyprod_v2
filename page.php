<?php get_header(); ?>

<?php
	if(have_posts()):
		while(have_posts()): the_post();
?>
<?php
$img = get_field('image_background');
if(!empty($img)):
	$alt = $img['alt'];
	$size = 'full-screen';
	$thumb = $img['sizes'][$size];
?>
<div class="cache-dot"></div>
<div id="background-image" style="background-image:url(<?php echo $thumb; ?>);"></div>
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
			<?php
				$form = get_field('formulaire');
				if(!empty($form)):
			?>
			<div class="container-form">
				<?php echo $form; ?>
			</div>
			<?php else: ?>
				<div class="left">
					<div class="content">
						<?php the_content(); ?>
					</div>
			<?php endif; ?>
		</div>
	</div>
<?php
		endwhile;
	endif;
?>
<?php get_footer(); ?>