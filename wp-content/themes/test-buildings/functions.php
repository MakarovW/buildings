<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<?php 
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/theme-classes/' . $class_name . '.php';
    if( file_exists( $file ) ) {
        include $file;
    }
});
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

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

    }
}
add_action('after_setup_theme', 'buildings_theme_setup');

add_action( 'init', 'register_buildings_post_type' );
function register_buildings_post_type() {

	register_taxonomy( 'buildingscat', [ 'buildings' ], [
		'label'                 => 'Тип постройки',
		'labels'                => array(
			'name'              => 'Типы постройки',
			'singular_name'     => 'Тип постройки',
			'search_items'      => 'Искать Тип постройки',
			'all_items'         => 'Все Типы постройки',
			'parent_item'       => 'Родит. тип постройки',
			'parent_item_colon' => 'Родит. тип постройки:',
			'edit_item'         => 'Ред. тип постройки',
			'update_item'       => 'Обновить тип постройки',
			'add_new_item'      => 'Добавить тип постройки',
			'new_item_name'     => 'Новый тип постройки',
			'menu_name'         => 'Тип постройки',
		),
		'description'           => 'Типы постройки',
		'public'                => true,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'rewrite'               => array('slug'=>'buildings_cat', 'hierarchical'=>false, 'with_front'=>true ),
		'show_admin_column'     => true,
	] );

	register_taxonomy( 'housing', [ 'buildings' ], [
		'label'                 => 'Класс жилья',
		'labels'                => array(
			'name'              => 'Классы жилья',
			'singular_name'     => 'Класс жилья',
			'search_items'      => 'Искать Класс жилья',
			'all_items'         => 'Все классы жилья',
			'parent_item'       => 'Родит. Класс жилья',
			'parent_item_colon' => 'Родит. Класс жилья:',
			'edit_item'         => 'Ред. Класс жилья',
			'update_item'       => 'Обновить Класс жилья',
			'add_new_item'      => 'Добавить Класс жилья',
			'new_item_name'     => 'Новый Класс жилья',
			'menu_name'         => 'Класс жилья',
		),
		'description'           => 'Классы жилья',
		'public'                => true,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'show_admin_column'     => true,
	] );

    /* register_taxonomy( 'deadline', [ 'buildings' ], [
		'label'                 => 'Срок сдачи',
		'labels'                => array(
			'name'              => 'Сроки сдачи',
			'singular_name'     => 'Срок сдачи',
			'search_items'      => 'Искать Срок сдачи',
			'all_items'         => 'Все сроки сдачи',
			'parent_item'       => 'Родит. Срок сдачи',
			'parent_item_colon' => 'Родит. Срок сдачи:',
			'edit_item'         => 'Ред. Срок сдачи',
			'update_item'       => 'Обновить Срок сдачи',
			'add_new_item'      => 'Добавить Срок сдачи',
			'new_item_name'     => 'Новый Срок сдачи',
			'menu_name'         => 'Срок сдачи',
		),
		'description'           => 'Сроки сдачи',
		'public'                => true,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'show_admin_column'     => true,
	] ); */

	register_taxonomy( 'housing', [ 'buildings' ], [
		'label'                 => 'Класс жилья',
		'labels'                => array(
			'name'              => 'Классы жилья',
			'singular_name'     => 'Класс жилья',
			'search_items'      => 'Искать Класс жилья',
			'all_items'         => 'Все классы жилья',
			'parent_item'       => 'Родит. Класс жилья',
			'parent_item_colon' => 'Родит. Класс жилья:',
			'edit_item'         => 'Ред. Класс жилья',
			'update_item'       => 'Обновить Класс жилья',
			'add_new_item'      => 'Добавить Класс жилья',
			'new_item_name'     => 'Новый Класс жилья',
			'menu_name'         => 'Класс жилья',
		),
		'description'           => 'Классы жилья',
		'public'                => true,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'show_admin_column'     => true,
	] );    

	register_post_type( 'buildings', [
		'label'               => 'Постройки',
		'labels'              => array(
			'name'          => 'Постройки',
			'singular_name' => 'Постройка',
			'menu_name'     => 'Постройки',
			'all_items'     => 'Все постройки',
			'add_new'       => 'Добавить постройку',
			'add_new_item'  => 'Добавить новая постройки',
			'edit'          => 'Редактировать',
			'edit_item'     => 'Редактировать постройку',
			'new_item'      => 'Новая пострйока',
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'buildings', 'with_front'=>true ),
		'has_archive'         => 'buildings',
		'query_var'           => true,
		'supports'            => array(
                                    'title', 
                                    'editor',
                                    'excerpt',
                                    'thumbnail'
                                ),
		'taxonomies'          => array( 'buildingscat' ),
	] );
    flush_rewrite_rules();
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );
function theme_scripts() {
    $in_footer = true;
    
    wp_enqueue_script( 'jquery.min', get_template_directory_uri() . '/js/jquery-2.2.4.min.js', [], null, !$in_footer);
	wp_enqueue_script( 'popper.min', get_template_directory_uri() . '/libs/bootstrap/js/popper.min.js', [], null, $in_footer);
    wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/libs/bootstrap/js/bootstrap.min.js', [], null, $in_footer);
    wp_enqueue_script( 'ofi.min', get_template_directory_uri() . '/libs/ofi/ofi.min.js', [], null, $in_footer);
    if( !is_single() ) {
        wp_enqueue_script( 'wow.min', get_template_directory_uri() . '/libs/wowjs/wow.min.js', [], null, $in_footer);
    }
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', [], null, $in_footer);
    wp_localize_script( 'scripts', 'scriptsMain', [
        'homeIconPath' => get_template_directory_uri(),
    ] );

    //wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/libs/bootstrap/css/bootstrap.min.css' );
    if( is_single() ) {
        wp_enqueue_script( 'api-maps.yandex', 'https://api-maps.yandex.ru/2.1/?apikey=f7f5866c-fcab-4da8-94d7-cdbdb39c7d22&lang=ru_RU', [], null, !$in_footer);
    }

    if( is_archive() || is_tax() ) {
        wp_enqueue_script( 'theme-filter', get_template_directory_uri() . '/js/theme-filter.js', ['scripts'], null, $in_footer);
        wp_localize_script( 'theme-filter', 'themeFilterObject', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
        ] );
    }

    //styles
    wp_enqueue_style( 'custom.min', get_template_directory_uri() . '/css/custom.css' );
    wp_enqueue_style( 'icon-font.min', get_template_directory_uri() . '/fonts/icomoon/icon-font.css' );
    wp_enqueue_style( 'animate.min', get_template_directory_uri() . '/libs/animate/animate.min.css' );
    wp_enqueue_style( 'style.min', get_template_directory_uri() . '/css/style.min.css' );
}

function bl_remove_core_block_styles() {
	global $wp_styles;

	foreach ( $wp_styles->queue as $key => $handle ) {
		if ( strpos( $handle, 'wp-block-' ) === 0 ) {
			wp_dequeue_style( $handle );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'bl_remove_core_block_styles' );

function get_breadcrumbs() : array {
    $breadcrumbs = [
        [
            'href'  => get_home_url(),
            'title' => 'Главная'
        ]
    ];
    if ( is_category() || is_tax() || is_single() ) {
        if ( is_single() ) {
            $category_object = get_the_terms( get_the_ID(),'buildingscat' );
            if( $category = $category_object[0] ) {
                $breadcrumbs[] = [
                    'href'  => get_category_link( $category->term_id ),
                    'title' => $category->name
                ];
            }

            $breadcrumbs[] = [
                'href'  => false,
                'title' => get_the_title()
            ];
        } else {
            $breadcrumbs[] = [
                'href'  => false,
                'title' => single_term_title('', false)
            ];
        }
    } elseif ( is_page() ) {
        $breadcrumbs[] = [
            'href'  => false,
            'title' => get_the_title()
        ];
    } elseif ( is_search() ) {
        $breadcrumbs[] = [
            'href'  => false,
            'title' => the_search_query()
        ];
    }
    return $breadcrumbs;
}

function render_breadcrumbs() {
    $breadcrumbs = get_breadcrumbs();
    $last_key = array_key_last($breadcrumbs);
    $render_breadcrumbs_string = null;
    foreach( $breadcrumbs as $k => $breadcrumb ) {
        $breadcrumb = (object) $breadcrumb;
        $href = $breadcrumb->href ? 'href="'.$breadcrumb->href.'"' : '';
        
        if( $k === $last_key ) {
            $render_breadcrumbs_string .= $breadcrumb->title;
        } else {
            $render_breadcrumbs_string .= "<a {$href}>{$breadcrumb->title}</a>";
            $render_breadcrumbs_string .= '<span class="breadcrumb-separator"> > </span>';
        }
    }
    echo sprintf('
    <nav class="page-breadcrumb" itemprop="breadcrumb">
        %s
    </nav>
    ', $render_breadcrumbs_string );
}

function get_query_filter_string_args() {
    $filter_query = isset( $_GET['filter'] ) && !empty( $_GET['filter'] ) ? $_GET['filter'] : null;
    
    if( !$filter_query ) {
        $try_filter_args = apply_filters( 'theme_filter_parse_query_string', $filter_query );
        if( isset( $try_filter_args ) && !empty( $try_filter_args ) ) {
            $filter_query = $try_filter_args;
        }
    }
    return $filter_query;
}

add_action('pre_get_posts','building_query_modify');
function building_query_modify( $query ) {

    $ajaxQuery = isset( $query->query_vars['ajax_buildings'] );

    if( !$ajaxQuery || $query->get('post_type') != 'buildings' ) {
        if( is_admin() || !is_post_type_archive( 'buildings' ) ) {
            //|| !is_tax( 'buildingscat' ) || !is_tax( 'housing' )
            return $query;
        }
    }

    $filter_query = get_query_filter_string_args();
 
    if( !$filter_query ) {
        return $query;
    }

    $parsed_filter_args = theme_filter_parse_string_args( $filter_query );
    global $building_filter_args;
    $building_filter_args = $parsed_filter_args;

    if( isset( $parsed_filter_args['housing'] ) ) {
        $tax_query = $query->get( 'tax_query', [] );;
        $tax_query[] = array(
            'taxonomy' => 'housing',
            'field' => 'id',
            'terms' => $parsed_filter_args['housing'],
            'operator' => 'IN'
        );
        $query->set( 'tax_query', $tax_query );
    }

    if( isset( $parsed_filter_args['deadline'] ) ) {
        $deadline_type = $parsed_filter_args['deadline'];
        $allow_deadlines = ['passed', 'this-year', 'next-year'];
        if( in_array( $deadline_type, $allow_deadlines ) ) {
            $new_meta_query = [];
            $deadline_key = 'building_features_lease';
            if( $deadline_type == 'passed' ) {
                $new_meta_query = array(
                    'key'       => $deadline_key,
                    'value'     => date('Y-m-d'),
                    'type'      => 'DATE',
                    'compare'   => '<='
                );
            }
            if( $deadline_type == 'this-year' ) {
                $new_meta_query = array(
                    'key'       => $deadline_key,
                    'value'     => [date('Y-01-01', strtotime("-1 year", time())), date('Y-01-01', strtotime("+1 year", time()))],
                    'type'      => 'DATE',
                    'compare'   => 'between'
                );
            }
            if( $deadline_type == 'next-year' ) {
                $new_meta_query = array(
                    'key'       => $deadline_key,
                    'value'     => date('Y-01-01', strtotime("+1 year", time())),
                    'type'      => 'DATE',
                    'compare'   => '>='
                );
            }

            $meta_query = $query->get( 'meta_query', [] );
            $meta_query[] = $new_meta_query;
            $query->set( 'meta_query', $meta_query );
        }

    }

    if( is_archive() ) {
        // todo
    } elseif ( is_tax() ) {
        // todo
    }

    if( isset( $parsed_filter_args['page'] ) ) {
        $offset = $parsed_filter_args['page'] * get_option( 'posts_per_page' );
        $query->set('offset', $offset );
    }

    // todo : load pagination links or load prev post before current page number

    return $query;

}

//add_filter( 'posts_clauses', 'theme_debug_clauses' );
function theme_debug_clauses( $clauses ) {
    var_dump($clauses);
	return $clauses;
}

function theme_filter_parse_string_args( $string_args ) {
    $main_args_array = explode( '|', trim( $string_args ) );
    $result_filter_args = [];
    if( is_array( $main_args_array ) ) {
        foreach( $main_args_array as $basic_string ) {
            if( !empty( trim($basic_string) ) ) {
                $basic_args = explode( ':', $basic_string );
                if( $basic_args && is_array( $basic_args ) ) {
                    $validated_basic_args = (object) validate_filter_basic_args( $basic_args );
                    if( $validated_basic_args ) {
                        $result_filter_args[ $validated_basic_args->key ] = $validated_basic_args->values;
                    }
                }
            }
        }
    }
    return $result_filter_args;
}

function validate_filter_basic_args( $basic_args ) : array {
    $resultArgs = [];
    $allow_filter_keys = [
        'proximity' => 'array',
        'deadline'  => 'string',
        'housing'   => 'termsids',
        'page'      => 'number',
    ];
    $key    = $basic_args[0];
    $values = $basic_args[1];
    if( in_array( $key, array_keys( $allow_filter_keys ) ) ) {
        $validator = $allow_filter_keys[$key];
        if( $validator === 'array' ) {
            $validator_values = explode( ',', $values );
            if( $validator_values ) {
                $simple_validated_values = [];
                foreach( $validator_values as $value ) {
                    $simple_validated_values[] = (string) $value;
                }
                $resultArgs = [
                    'key'   => $key,
                    'values' => $simple_validated_values
                ];
            }
        }elseif( $validator === 'string') {
            $resultArgs = [
                'key'   => $key,
                'values' => (string) $values
            ];
        }elseif( $validator === 'number' ) {
            $resultArgs = [
                'key'   => $key,
                'values' => (int) $values
            ];
        }elseif( $validator == 'termsids' ) {
            $validator_values = explode( ',', $values );
            if( $validator_values ) {
                $simple_validated_values = [];
                foreach( $validator_values as $value ) {
                    $simple_validated_values[] = (int) $value;
                }
                $resultArgs = [
                    'key'   => $key,
                    'values' => $simple_validated_values
                ];
            }
        }
    }

    return !empty($resultArgs) ? $resultArgs : [];
}

function buildings_archive_is_last_page() {
    global $building_filter_args, $wp_query;
    $current_page = $building_filter_args && isset($building_filter_args['page'])
        ? (int) $building_filter_args['page']+1
        : 0;
    return $current_page >= (int) $wp_query->max_num_pages;
}

//ajax theme filter
add_action( 'wp_ajax_theme_filter', 'theme_filter_callback' );
add_action( 'wp_ajax_theme_filter_nopriv', 'theme_filter_callback' );

function theme_filter_callback() {

    add_filter('theme_filter_parse_query_string', function( $default_query_string ) {
        $is_query_exists = isset( $_POST['queryString'] ) && !empty( trim( $_POST['queryString'] ) );
        return $is_query_exists ? $_POST['queryString'] : null;
    }, 10);

    $query = new WP_Query( [
         'post_type'        => 'buildings',
         'ajax_buildings'   => true,
    ]);
    
    global $building_filter_args;
    $current_page = $building_filter_args && isset($building_filter_args['page'])
        ? (int) $building_filter_args['page']+1
        : 0;

    $result = [
        //'current_page'  => $current_page,
        //'maxnumpages'   => $query->max_num_pages,
        'status'        => false,
        'html'          => '',
        'isLastPage'    => $current_page >= (int) $query->max_num_pages,
    ];

    if( $query->have_posts() ) {
        ob_start();
        while( $query->have_posts() ) {
            $query->the_post();
            get_template_part('templates/archive', 'single-buildings');
        }
        $result['html']    .= ob_get_clean();
        $result['status']   = true;
    } else {
        $result['html']         = 'This is all building for this filter! Try change filter parameters and Apply!';
        $result['isLastPage']   = true;
    }

    wp_reset_postdata();

    wp_send_json( $result ); // status \!code.. 

	wp_die();
}
