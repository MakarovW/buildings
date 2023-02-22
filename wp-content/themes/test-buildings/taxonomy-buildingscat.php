
<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php get_header(); ?>
<?php $queired_object = get_queried_object(); ?>
<?php if ( have_posts() ) : ?>
	<div class="page-content">
		<h1 class="visuallyhidden"><?php echo $queired_object->name; ?></h1>
		<div class="page-loop__wrapper loop tab-content tab-content__active">
			<ul class="page-loop with-filter">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<?php get_template_part('templates/archive', 'single-buildings'); ?>
				<?php endwhile; ?>
			</ul>
			<div class="show-more">
			<button class="show-more__button">
				<span class="show-more__button-icon"></span> Показать еще </button>
			</div>
		</div>
		<div class="page-map tab-content map">
			<h1>Тут будет карта</h1>
		</div>
	</div>
	<?php get_template_part('templates/archive', 'page-filter'); ?>
<?php else : ?>
	<?php echo 'Content not found!'; ?>
<?php endif; ?>

<?php
get_footer();