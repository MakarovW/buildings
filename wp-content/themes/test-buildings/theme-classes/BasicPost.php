<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class BasicPost {
    public $ID = null;
    
    function __construct( $ID = null )
    {
        $this->ID = $ID ? $ID : get_the_ID();
    }

    function the_title() {
        the_title();
    }

    function get_the_title() {
        return get_the_title( $this->ID );
    }

    function the_content() {
        the_content();
    }

    function get_thumbnail_url() {
        return get_the_post_thumbnail_url( $this->ID );
    }

    function get_post_link() {
        return get_post_permalink( $this->ID );
    }

    function getField( $selector, $post_id = false, $format_value = true ) {
        $post_id = $post_id ? $this->ID : false;
        return function_exists('get_field') ? get_field( $selector, $post_id, $format_value ) : null;
    }
    
}