<?php get_header(); ?>
<div class="container-1400">
	<div class="page-404">
		<?php
		$img = get_field('image_404','option');
		if(!empty($img)):
			$alt = $img['alt'];
			$size = 'medium';
			$thumb = $img['sizes'][$size];
		?>
			<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
		<?php endif; ?>
		<div class="content">
			<h1><?php the_field('titre_404','option'); ?></h1>
			<?php the_field('texte_404','option'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>