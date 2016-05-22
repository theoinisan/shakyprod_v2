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
		<div class="single-real">
			<div class="anim-title">
				<h1 class="single" style="background-color:<?php the_field('couleur'); ?>"><?php the_title(); ?></h1>
			</div>
			<div class="left">
				<div class="content" style="border-color:<?php the_field('couleur'); ?>">
					<?php the_content(); ?>
				</div>
				<?php
				if (have_rows('selecteur_media')):
				while (have_rows('selecteur_media')): the_row();
				if(get_row_layout() == 'galerie'):
				?>
				<h4 class="photo">Photos</h4>
				<span class="photo">+ Photos</span>
					<div class="galerie">
						<?php 
						$images = get_sub_field('galerie_realisation');
						if( $images ): ?>
						    <ul>
						        <?php foreach( $images as $image ): ?>
						            <li>
						                <a data-lightbox="galerie" href="<?php echo $image['url']; ?>" data-title="<?php echo $image['title']; ?>">
						                     <img src="<?php echo $image['sizes']['galerie']; ?>" alt="<?php echo $image['alt']; ?>" />
						                </a>
						            </li>
						        <?php endforeach; ?>
						    </ul>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php
				endwhile;
				endif;
				?>
			</div>
			<div class="right">
				<?php
				if (have_rows('selecteur_media')):
				while (have_rows('selecteur_media')): the_row();
				if(get_row_layout() == 'video'):
				?>
					<div class="embed-container">
						<?php the_sub_field('video_realisation'); ?>
					</div>
				<?php endif; ?>
				<?php
				endwhile;
				endif;
				?>
				<div class="others-real">
					<?php 
					$posts = get_field('selecteur_slider');
					if( $posts ): ?>
					<h4>Autres projets</h4>
				    <?php foreach( $posts as $post): ?>
				        <?php setup_postdata($post); ?>
				        <div class="real-sug">
					        <a href="<?php the_permalink(); ?>">
								<?php
								$img = get_field('image_slider');
								if(!empty($img)):
									$alt = $img['alt'];
									$size = 'bloc-accueil';
									$thumb = $img['sizes'][$size];
								?>
									<h3><?php the_title(); ?></h3>
									<div class="cache-bl"></div>
									<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
								<?php endif; ?>
							</a>
						</div>
				    <?php endforeach; ?>
		    		<?php wp_reset_postdata();  ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php
		endwhile;
	endif;
?>
<?php get_footer(); ?>