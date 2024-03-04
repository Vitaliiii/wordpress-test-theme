<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Example
 */

get_header();

$month = date('m');

$args = array(
	'post_type' => 'book',
	'monthnum' => $month
);

$query = new WP_Query($args);
?>

	<main id="primary" class="site-main">
		<section class="hero">
			<div class="container">
				<div class="hero__content">
					<?php if(get_field('title')):?>
						<h1><?php the_field('title');?></h1>
					<?php endif;?>
					<?php if(get_field('subtitle')):?>
						<p><?php the_field('subtitle');?></p>
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

								get_template_part('/template-parts/components/book-item', get_post_format());
								
							endwhile;
						
						else:

							get_template_part('/template-parts/components/no-post', 'none');

						endif;
						wp_reset_postdata();
					?>    
				</div>
				<div class="posts__sidebar">
					<div id="secondary" class="widget-area">
						<?php dynamic_sidebar( 'sidebar-book' ); ?>
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->
	
<?php
get_footer();

