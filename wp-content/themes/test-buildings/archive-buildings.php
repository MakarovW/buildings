
<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php get_header(); ?>
<?php $isLastPage = buildings_archive_is_last_page(); ?>
	<div class="page-content">
		<h1 class="visuallyhidden">Новостройки</h1>
		<div class="page-loop__wrapper loop tab-content tab-content__active">
			<ul class="page-loop with-filter" id="theme-filter-1">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<?php get_template_part('templates/archive', 'single-buildings'); ?>
				<?php endwhile; ?>
				<?php else : ?>
					<?php echo 'Content not found!'; ?>
				<?php endif; ?>
			</ul>
			<div class="show-more <?php echo $isLastPage ?  'd-none' : ''; ?>">
			<button class="show-more__button" id="showMoreButton">
				<span class="show-more__button-icon"></span> Показать еще </button>
			</div>
		</div>
		<div class="page-map tab-content map">
			<h1>Тут будет карта</h1>
		</div>
	</div>
	<?php get_template_part('templates/archive', 'page-filter'); ?>

<?php
get_footer();