<?php /* Template Name: PageArmaTuPC */ ?>

<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Cartzilla
 */

get_header();

while ( have_posts() ) :
	the_post();

	/**
	 * Fires before the single post content
	 */
	//do_action( 'cartzilla_single_post_before' );

	get_template_part( 'templates/contents/content', 'armatupc' );
	

	/**
	 * Fires after the single post content
	 */
	//do_action( 'cartzilla_single_post_after' );

endwhile;

get_footer();