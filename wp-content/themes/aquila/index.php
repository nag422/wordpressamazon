<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Aquila
 * @since Aquila 1.0
 */
get_header();
?>
 


<div class="wrapper">
	<?php get_template_part('template-parts/navbar/nav'); ?>
	<?php get_template_part('template-parts/mainsidebar/mainsidebar'); ?>
	<?php get_template_part('template-parts/contentwrapper/contentwrapper'); ?>
	<?php get_template_part('template-parts/footer/footer'); ?>
</div>




<?php
get_footer();
?>