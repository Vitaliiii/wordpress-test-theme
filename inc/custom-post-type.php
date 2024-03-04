<?php
/**
 * Sample implementation of the Custom Post Type
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Default Theme
 */


 add_action( 'init', 'book_register_post_type_init' ); // Function execution inside init hook

 function book_register_post_type_init() {
 
	 $labels = array(
		 'name'                => 'Books',
		 'singular_name'       => 'Book',
		 'add_new'             => 'Add new',
		 'add_new_item'        => 'Add new Book',
		 'edit_item'           => 'Edit',
		 'new_item'            => 'New Book',
		 'view_item'           => 'View Book',
		 'search_items'        => 'Search Books',
		 'not_found'           => 'Book not found', 
		 'not_found_in_trash'  => 'Book not found in Tresh', 
		 'menu_name'           => 'Books',
	 );
 
	 $args = array(
		 'labels'              => $labels,
		 'hierarchical'        => false,
		 'taxonomies'          => array('genre, author'),
		 'public'              => true,
		 'publicly_queryable'  => true,
		 'show_ui'             => true,
		 'show_in_menu'        => true,
		 'show_in_admin_bar'   => true,
		 'menu_position'       => 22,
		 'menu_icon'           => 'dashicons-book',
		 'show_in_nav_menus'   => true,
		 'exclude_from_search' => false,
		 'has_archive'         => true,
		 'query_var'           => true,
		 'can_export'          => true,
		 'supports'            => array('title', 'thumbnail', 'editor', 'excerpt')
	 );
 
	 register_post_type( 'book', $args );
 }
 
 add_action( 'init', 'register_genre_taxonomy' );
 
 function register_genre_taxonomy() {
	
	 $labels = array(
		 'name'						=> 'Genres',
		 'singular_name'			=> 'Genre', 
		 'search_items'				=> 'Search Genres', 
		 'popular_items'			=> 'Popular Genres',
		 'all_items'				=> 'All Genres',
		 'parent_item'				=> 'Parent Genre',
		 'parent_item_colon'		=> 'Parent Genre',
		 'edit_item'				=> 'Edit Genre',
		 'update_item'				=> 'Update Genre',
		 'add_new_item'				=> 'Add new Genre',
		 'new_item_name'			=> 'New Genre',
		 'add_or_remove_items'		=> 'Add or remove Genre',
		 'choose_from_most_used'	=> 'Choose Genre from most used',
		 'menu_name'				=> 'Genres',
	 );
 
	 $args = array(
		 'labels'            => $labels,
		 'show_admin_column' => true,
		 'public'            => true,
		 'publicly_queryable'=> true,
		 'show_in_nav_menus' => true,
		 'hierarchical'      => true,
		 'show_tagcloud'     => true,
		 'show_ui'           => true,
		 'query_var'         => true,
		 'rewrite'           => true,
		 'query_var'         => true,
		 'has_archive'       => false,
		 'capabilities'      => array(),
	 );
 
	 register_taxonomy( 'genre', array( 'book' ), $args );
 }
 
 add_action( 'init', 'register_author_taxonomy' );
 
 function register_author_taxonomy() {
	
	 $labels = array(
		 'name'						=> 'Authors',
		 'singular_name'			=> 'Author', 
		 'search_items'				=> 'Search Authors', 
		 'popular_items'			=> 'Popular Authors',
		 'all_items'				=> 'All Authors',
		 'parent_item'				=> 'Parent Author',
		 'parent_item_colon'		=> 'Parent Author',
		 'edit_item'				=> 'Edit Author',
		 'update_item'				=> 'Update Author',
		 'add_new_item'				=> 'Add new Author',
		 'new_item_name'			=> 'New Author',
		 'add_or_remove_items'		=> 'Add or remove Author',
		 'choose_from_most_used'	=> 'Choose Author from most used',
		 'menu_name'				=> 'Authors',
	 );
 
	 $args = array(
		 'labels'            => $labels,
		 'show_admin_column' => true,
		 'public'            => true,
		 'publicly_queryable'=> true,
		 'show_in_nav_menus' => true,
		 'hierarchical'      => true,
		 'show_tagcloud'     => true,
		 'show_ui'           => true,
		 'query_var'         => true,
		 'rewrite'           => true,
		 'query_var'         => true,
		 'has_archive'       => false,
		 'capabilities'      => array(),
	 );
 
	 register_taxonomy( 'author', array( 'book' ), $args );
}