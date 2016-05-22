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
	<h1 class="standard">Réalisations</h1>
    <?php 
    $taxonomy     = 'type';
	$orderby      = 'name';
	$show_count   = false;
	$pad_counts   = false;
	$hierarchical = true;
	$title        = '';
	 
	$args = array(
	  'taxonomy'     => $taxonomy,
	  'orderby'      => $orderby,
	  'show_count'   => $show_count,
	  'pad_counts'   => $pad_counts,
	  'hierarchical' => $hierarchical,
	  'title_li'     => $title
	);
	?>
	<div class="container-type-menu">
		<div class="container-1400">
			<ul class="type-menu">
			
				<li><a href="<?php echo get_site_url() . '/realisations'; ?>">Tous</a></li>
		   		<?php wp_list_categories( $args ); ?>
			</ul>
		</div>
	</div>
</div>
<?php
	if(have_posts()):
		while(have_posts()): the_post();
?>
	<div class="realisation anim-real">
		<a href="<?php the_permalink(); ?>">
			<?php
			$img = get_field('image_slider');
			if(!empty($img)):
				$alt = $img['alt'];
				$size = 'slider';
				$thumb = $img['sizes'][$size];
			?>
				<div class="container-1400">
					<h2 style="background-color: <?php the_field('couleur'); ?>;"><?php the_title(); ?></h2>
					<p style="border-color: <?php the_field('couleur'); ?>"><?php the_field('extrait'); ?></p>
				</div>
				<div class="cache-bl"></div>
				<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
			<?php endif; ?>
		</a>
	</div>
<?php
		endwhile;
	endif;
?>
<?php get_footer(); ?>