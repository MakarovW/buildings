<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<?php
/**
 * buildings functions and definitions [buildings]
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * buildings
 * @package buildings
 */

if (!function_exists('buildings_theme_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @return void
     * @since buildings 1.0
     *
     */
    function buildings_theme_setup() {

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(870, 400);

        add_theme_support('menus');

        register_nav_menus(
            [
                'menu-primary' => esc_html__('Primary menu', 'buildings'),
            ]
        );

    }
}
add_action('after_setup_theme', 'buildings_theme_setup');