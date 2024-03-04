<?php
/**
 * The template for displaying posts Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Default Theme
 */

get_header();

$CPTpage_ID = get_option('page_for_posts');

$args = array(
	'post_type' => 'post'
);

$query = new WP_Query($args);
?>

	<main id="primary" class="site-main">
		<section class="hero">
			<div class="container">
				<div class="hero__content">
					<?php if(get_field('title', $CPTpage_ID)):?>
						<h1><?php the_field('title', $CPTpage_ID);?></h1>
					<?php endif;?>
					<?php if(get_field('subtitle', $CPTpage_ID)):?>
						<p><?php the_field('subtitle', $CPTpage_ID);?></p>
					<?php endif;?>
				</div>
			</div>
		</section>

		<section class="posts">
			<div class="container">
				<div class="posts__content">
					<div class="posts__list">
						<?php
							if ($query->have_posts()) :

								while ($query->have_posts()): $query->the_post();  

									get_template_part('/template-parts/components/post-item', get_post_format());
									
								endwhile;
							
							else:

								get_template_part('/template-parts/components/no-post', 'none');

							endif;
							wp_reset_postdata();
						?>           
					</div>
					<div class="posts__sidebar">
						<?php get_sidebar();?>
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
