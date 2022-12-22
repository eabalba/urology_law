<?php get_header(); 
if ( have_posts() ): while ( have_posts() ) : the_post();
 ?>
<main id="main">

	<?php 
		// Varibles
		$titleImage = get_field('title_image');
		$pageTitle = get_field('page_title');
		$subtitle = get_field('subtitle');
		$contentType = get_field('content_type');
		$txtContent = get_field('text_content');
		$subtitleSize = get_field('font_size');
	?>
	<section class="page-title">
		<?php
		/**
		 * Block Name: Hero
		 */


		// Create id attribute allowing for custom "anchor" value.
		$id = 'block-' . $block['id'];
		if( !empty($block['anchor']) ) {
			$id = $block['anchor'];
		}

		// Create class attribute allowing for custom "className" and "align" values.
		$className = 'block block-hero';
		if( !empty($block['className']) ) {
			$className .= ' ' . $block['className'];
		}
		if( !empty($block['backgroundColor']) ) {
			$className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
		}
		;?>
		

		<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
			
			<div class="hero-wrapper <?php if ($post->ID == 310):;?>contact-page<?php endif;?> <?php if(!empty($titleImage) || ($post->ID == 310)):;?> full-height <?php endif;?><?php if ( $contentType == 'testimonials'):;?>with-testimonials<?php elseif ( $contentType == 'text'):;?>without-testimonials<?php endif;?>" style="display:<?php if(!empty($titleImage)): ;?>grid <?php else:?> block <?php endif;?>">
				<div class="hero-content-column" style="<?php if ( $contentType == 'testimonials'):;?>grid-area: heroContent; <?php endif; ?>">
					<div class="grey-bg-filler <?php if(empty($titleImage)):;?>no-title-image<?php endif;?>"></div>
					<div class="hero-content">
						<h1 class="hero-title"><?php echo esc_html($pageTitle) ;?></h1>
						<p class="hero-subtitle" style="font-size:<?php if ( $subtitleSize == 'small' ) : ;?> var(--step-0); <?php elseif ( $subtitleSize == 'regular' ) : ;?>1.7em; <?php elseif ( $subtitleSize == 'large' ) : ;?> 2.2em; <?php endif; ?>"><?php echo esc_html($subtitle) ;?></p>
						<!--Print out textbox content -->
					
						<?php if ( $contentType == 'text') : ;?>
							<div class="hero-desc-wrapper">
								<?php echo($txtContent) ;?>
							</div>
							
						<?php endif;?>
					</div>

				</div>
				<?php if ( $contentType == 'testimonials') : ;?>
				<!--Print out testimonials -->
				<div class="hero-testimonials" style="<?php if ( $contentType == 'testimonials'):;?>grid-area: testimonials; <?php endif; ?>">
					<?php if( have_rows('testimonials_repeater', 'options') ): ?>
					<div class="testimonial-wrapper">
						<ul class="testimonial-list testimonial-slider">
							<?php 
							while( have_rows('testimonials_repeater', 'options') ) : the_row();
							//Variables for testimonials
							$review = get_sub_field('review');
							$reviewer = get_sub_field('name_location'); ?>
								<li class="testimonial-single">
									<p class="testimonial-review">
										<?php echo('"'.$review.'"') ;?>
									</p>
									<p class="testimonial-reviewer"> 
										<?php echo($reviewer) ;?>
									</p>
								</li>
							<?php endwhile ;?>
						</ul>
					</div>
					<?php endif;?>
				</div>
				<?php endif ;?>
				<div class="hero-image" style="<?php if ( $contentType == 'testimonials'):;?>grid-area: heroImage; <?php endif; ?>">
					<?php if( !empty( $titleImage ) ): ?>
					<img src="<?php echo esc_url($titleImage['url']); ?>" alt="<?php echo esc_attr($titleImage['alt']); ?>" />

					<?php endif;?>
				</div>
			
			</div>

			<div class="contact-sidebar">
				<?php
				if ($post->ID == 310): 
					// get reusable gutenberg block:
					$gblock = get_post( 56 );
					echo apply_filters( 'the_content', $gblock->post_content );
				?>
				<?php endif;?>
			</div>
		</div>

	</section>

	<section class="page-content">
		<?php the_content(); ?>


	
	</section>


	<section class="page-sidebar" style="<?php if ($post->ID == 310):;?>display:none <?php endif;?>">
		<?php 
		$args = array(  
			'post_type' => 'main_sidebar',
			'post_status' => 'publish',
			'posts_per_page' => 8, 
			'orderby' => 'title', 
			'order' => 'ASC', 
		);

		$loop = new WP_Query( $args ); 
			
		while ( $loop->have_posts() ) : $loop->the_post(); 
			$loopID = get_post($loop->ID);
			echo apply_filters('the_content',$loopID->post_content);
		endwhile;

		wp_reset_postdata(); 
		?>
	</section>
</main>
<?php endwhile; endif?>
<?php get_footer(); ?>