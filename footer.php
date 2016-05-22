</div>
<footer>
	<div class="container-1400">
		<span id="button-contact">Contact</span>
		<div class="container-footer-mobile">
			<?php
			if(have_rows('coordonnees','option')):
			?>
				<nav>
					<ul>
						<?php
						while(have_rows('coordonnees','option')): the_row();
						?>
							<li><?php the_sub_field('element_de_coordonnees'); ?></li>
						<?php endwhile; ?>
					</ul>
				</nav>
			<?php endif; ?>
			<?php
			if(have_rows('rs','option')):
			?>
				<nav class="social">
					<ul>
						<?php
						while(have_rows('rs','option')): the_row();
						?>
							<li><a href="<?php the_sub_field('lien'); ?>" style="background-image:url(<?php the_sub_field('picto'); ?>);"></a></li>
						<?php endwhile; ?>
					</ul>
				</nav>
			<?php endif; ?>
		</div>
	</div>
    <?php wp_footer(); ?>
</footer>

</body>
</html>