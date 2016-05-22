<?php get_header(); ?>
<div id="intro">
	<div class="top"></div>
	<div class="bottom"></div>
	<?php
	$logo = get_field('png_logo','option');
	if(!empty($logo)):
		$alt = $logo['alt'];
		$size = 'logo-full';
		$thumb = $logo['sizes'][$size];
	?>
		<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
	<?php endif; ?>
</div>

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
<div id="home-content">
	<?php 

	$posts = get_field('selecteur_slider','option');

	if( $posts ): ?>
	    <div class="swiper-container">
			<div class="swiper-wrapper">
			    <?php foreach( $posts as $post): ?>
			        <?php setup_postdata($post); ?>
			        <div class="swiper-slide">
				        <div class="realisation">
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
			        </div>
			    <?php endforeach; ?>
	    	</div>
			<div class="swiper-button-prev swiper-button-white"></div>
	    	<div class="swiper-button-next swiper-button-white"></div>
		</div>	
	    <?php wp_reset_postdata();  ?>
	<?php endif; ?>
		
	<div class="container-1400">
		<h1><?php the_field('titre_site','option'); ?></h1>
		<div class="grid">
			<?php
			if (have_rows('blocs_accueil','option')):
				while (have_rows('blocs_accueil','option')): the_row();
			?>
				<div class="bloc">
					<?php
					$type = get_sub_field('type_lien');
					if($type == 'interne'):
					?>
					<a href="<?php the_sub_field('lien_interne'); ?>">
					<?php else: ?>
					<a href="<?php the_sub_field('lien_externe'); ?>" target="_blank">
					<?php endif; ?>
						<?php
						$imgBloc = get_sub_field('image','option');
						if(!empty($imgBloc)):
							$alt = $imgBloc['alt'];
							$size = 'bloc-accueil';
							$thumbBloc = $imgBloc['sizes'][$size];
						?>
							<img src="<?php echo $thumbBloc; ?>" alt="<?php echo $alt; ?>" />
						<?php endif; ?>
							<span><?php the_sub_field('titre'); ?></span>
							<div class="content">
								<h2><?php the_sub_field('titre'); ?></h2>
								<p><?php the_sub_field('description'); ?></p>
							</div>
					</a>
				</div>
			<?php
				endwhile;
			endif;
			?>
		</div>
	</div>

</div>

<?php get_footer(); ?>