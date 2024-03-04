<?php
/**
 * Sample implementation of the Custom Shortcodes
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Default Theme
 */


	function books_genre_shortcode($atts) {
		// Extract shortcode attributes
		$atts = shortcode_atts(
			array(
				'genre' => '', // Default genre
			),
			$atts,
			'books'
		);

		// Query books based on the provided genre
		$books_query = new WP_Query(array(
			'post_type' => 'book',
			'tax_query' => array(
				array(
					'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => $atts['genre'],
				),
			),
		));

		// Output books
		$output = '<ul>';
		if ($books_query->have_posts()) {
			while ($books_query->have_posts()) {
				$books_query->the_post();
				$output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
			}
		} else {
			$output .= '<li>No books found</li>';
		}
		$output .= '</ul>';

		// Reset post data
		wp_reset_postdata();

		return $output;
	}
	add_shortcode('books', 'books_genre_shortcode');

	add_filter( 'widget_text', 'shortcode_unautop');
	add_filter( 'widget_text', 'do_shortcode');