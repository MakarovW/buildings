<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$singleBuilding = new SingleBuilding();
?>
<?php get_header(); ?>
<div class="page-content">
<article class="post">
	<div class="post-header">
	<h1 class="page-title-h1"><?php $singleBuilding->the_title(); ?></h1>
	<span><?php echo $singleBuilding->get_company_name(); ?></span>
	<div class="post-header__details">
		<div class="address"><?php echo $singleBuilding->get_company_address(); ?></div>
		<?php if( $metro_list = $singleBuilding->get_metro_list() ) : ?>
			<?php foreach( $metro_list as $metro ) : $metro = (object) $metro; ?>
				<?php $icon = $metro->is_walking ? 'icon-walk-icon' : 'icon-bus'; ?>
				<?php $icon_color = '--green' || '--red'; // \?\?\? ?>
				<div class="metro">
					<span class="icon-metro icon-metro--green"></span>
						<?php echo $metro->title; ?>
						<span><?php echo $metro->closeness; ?> мин. <span class="<?php echo $icon; ?>"></span>
					</span>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	</div>
	<div class="post-image">
	<?php if( $image_url = $singleBuilding->get_thumbnail_url() ) : ?>
            <img src="<?php echo $image_url; ?>" alt="<?php echo $singleBuilding->get_the_title(); ?>">
    <?php endif; ?>
	<div class="page-loop__item-badges">
		<span class="badge">Услуги 0%</span>
		<span class="badge">Комфорт+</span>
	</div>
	<a href="#" class="favorites-link favorites-link__add" title="Добавить в Избранное" role="button"><span class="icon-heart"><span class="path1"></span><span class="path2"></span></span></a>
	</div>
	<h2 class="page-title-h1">Характеристики ЖК</h2>
	<ul class="post-specs">
		<?php if( $features_class = $singleBuilding->get_features_class() ) : ?>
			<li>
				<span class="icon-building"></span>
				<div class="post-specs__info">
				<span>Класс жилья</span>
				<p><?php echo $features_class; ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_constructive = $singleBuilding->get_features_constructive() ) : ?>
			<li>
				<span class="icon-brick"></span>
				<div class="post-specs__info">
				<span>Конструктив</span>
				<p><?php echo $features_constructive; ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_finish = $singleBuilding->get_features_finish() ) : ?>
			<li>
				<span class="icon-paint"></span>
				<div class="post-specs__info">
				<span>Отделка</span>
				<p> <?php echo $features_finish; ?> <span class="tip tip-info" data-toggle="popover" data-placement="top" data-content="And here's some amazing content. It's very engaging. Right?">
					<span class="icon-prompt"></span>
					</span>
				</p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_lease = $singleBuilding->get_features_lease() ) : ?>
			<li>
				<span class="icon-calendar"></span>
				<div class="post-specs__info">
				<span>Срок сдачи</span>
				<p><?php echo $features_lease->quarter; ?> кв. <?php echo $features_lease->year; ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_height = $singleBuilding->get_features_height() ) : ?>
			<li>
				<span class="icon-ruller"></span>
				<div class="post-specs__info">
				<span>Высота потолков</span>
				<p><?php echo $features_height; ?> м</p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_parking = $singleBuilding->get_features_parking() ) : ?>
			<li>
				<span class="icon-parking"></span>
				<div class="post-specs__info">
				<span>Подземный паркинг</span>
				<p><?php echo $features_parking; ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_storeys = $singleBuilding->get_features_storeys() ) : ?>
			<li>
				<span class="icon-stair"></span>
				<div class="post-specs__info">
				<span>Этажность</span>
				<p><?php echo $features_storeys; ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_price_group = $singleBuilding->get_features_price_group() ) : ?>
			<li>
				<span class="icon-wallet"></span>
				<div class="post-specs__info">
				<span>Ценовая группа</span>
				<p><?php echo $features_price_group; ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( $features_price_rating = $singleBuilding->get_features_price_rating() ) : ?>
			<li>
				<span class="icon-rating"></span>
				<div class="post-specs__info">
				<span>Рейтинг</span>
				<p><?php echo $features_price_rating; ?></p>
				</div>
			</li>
		<?php endif; ?>
	</ul>
	<h2 class="page-title-h1">Краткое описание</h2>
	<div class="post-text">
	<p><?php $singleBuilding->the_content(); ?></p>
	</div>
	<h2 class="page-title-h1">Карта</h2>
	<div class="post-map" id="post-map" style="width: 100%; height: 300px;"></div>
</article>
</div>
<div class="page-filter"></div>
<?php
get_footer();