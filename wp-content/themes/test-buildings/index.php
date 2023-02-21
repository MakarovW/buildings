<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<?php the_title(); ?>
	<?php the_content(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>