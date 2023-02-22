<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="robots" content="noindex">
    <?php wp_head(); ?>
</head>

<body>

	<main class="main">

		<div class="container">

            <?php if ( has_nav_menu( 'menu-primary' ) ) : ?>
                <nav id="site-navigation" class="primary-navigation" style="display: inline-block;margin-top: 50px;" aria-label="<?php esc_attr_e( 'Primary menu', 'twentytwentyone' ); ?>">
                    <?php wp_nav_menu(
                        array(
                            'theme_location'  => 'menu-primary',
                            'menu_class'      => 'menu-wrapper',
                            'container_class' => 'primary-menu-container',
                            'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
                            'fallback_cb'     => false,
                        )
                    ); ?>
                </nav><!-- #site-navigation -->
                <?php
            endif; ?>

			<div class="page-top">

            <?php render_breadcrumbs(); ?>

                <?php if( is_archive() ) : ?>
                    <div class="page-top__switchers">

                        <div class="container">
                            <div class="row">

                                <div class="page-top__switchers-inner">

                                    <a href="#" class="page-top__filter">
                                        <span class="icon-filter"></span>
                                        Фильтры
                                    </a>

                                    <a href="#" data-tab-name="loop" class="page-top__switcher tab-nav active">
                                        <span class="icon-grid"></span>
                                    </a>

                                    <a href="#" data-tab-name="map" class="page-top__switcher tab-nav">
                                        <span class="icon-marker"></span>
                                    </a>

                                </div>

                            </div>
                        </div>

                    </div>
                <?php endif; ?>

            </div>

            <div class="page-section">
