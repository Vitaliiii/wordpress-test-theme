<?php
/**
 * The template for displaying archive book page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Default Theme
 */

get_header();

$CPTname = get_post_type();
$CPTpage = get_page_by_path($CPTname);
$CPTpage_ID = $CPTpage->ID;
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
					<?php if ( have_posts() ) : ?>

						<?php
						
						while ( have_posts() ) :
							the_post();

							get_template_part( '/template-parts/components/book-item', get_post_type() );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/components/no-post', 'none' );

					endif;
					?>
				</div>
				<div class="posts__sidebar">
					<div id="secondary" class="widget-area">
						<?php dynamic_sidebar( 'sidebar-book' ); ?>
					</div>
				</div>
			</div>
		</section>\
	</main><!-- #main -->

<?php
get_footer();
