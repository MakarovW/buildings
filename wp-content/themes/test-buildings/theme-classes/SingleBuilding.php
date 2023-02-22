<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class SingleBuilding extends BasicPost {

    function get_company_name() {
        return $this->getField( 'building_company' );
    }

    function get_company_address() {
        return $this->getField( 'building_address' );
    }

    function get_metro_list() {
        return $this->getField( 'building_metro_list' );
    }

    /* search existed metro with min closeness time */
    function get_metro_closeness() {
        $closeness = null;
        $key = null;
        $metro_list = $this->get_metro_list();
        if( $metro_list && is_array( $metro_list ) ) {
            foreach( $metro_list as $k => $metro ) {
                $metro = (object) $metro;
                if( $closeness_dist = (int) $metro->closeness ) {
                    if( $closeness == null ) {
                        $closeness = $closeness_dist;
                    }
                    if( $closeness_dist <= $closeness ) {
                        $key = $k;
                    }
                }
            }
        }

        return $metro_list && $key !== null ? (object) $metro_list[$key] : null;
    }

    function get_features_class() {
        $housing_name = null;
        $post_housing_terms = get_the_terms( $this->ID, 'housing' );
        if( $post_housing_terms && !is_wp_error( $post_housing_terms ) ) {
            $housing_name = $post_housing_terms[0]->name;
        }
        return $housing_name;
    }

    function get_features_constructive() {
        return $this->getField( 'building_features_constructive' );
    }

    function get_features_finish() {
        return $this->getField( 'building_features_finish' );
    }
    
    function get_features_lease_field() {
        return $this->getField( 'building_features_lease' );
    }

    function get_features_lease() {
        $lease_data = $this->get_features_lease_field();
        $dateTime = $lease_data ? DateTime::createFromFormat("d/m/Y", (string) $lease_data) : false;
        return $lease_data && is_object($dateTime) ? (object) [
            'year'      => $dateTime->format('Y'),
            'quarter'   => $this->get_quarter( $dateTime ),
        ] : null;
    }

    function get_quarter( \DateTime $dateTime ){
        return (int) ceil( $dateTime->format('n') / 3 );
    }

    function get_features_height() {
        return $this->formatString( $this->getField( 'building_features_height' ) );
    }

    function get_features_parking() : string {
        return $this->getField( 'building_features_parking' ) ? 'Присутствует' : 'Отсутствует';
    }

    function get_features_storeys_min() {
        return $this->getField( 'building_features_storeys_min' );
    }

    function get_features_storeys_max() {
        return $this->getField( 'building_features_storeys_max' );
    }

    function get_features_storeys() {
        $min = $this->get_features_storeys_min();
        $max = $this->get_features_storeys_max();
        $storeys = $min && $max ? $min . '-' . $max : ( ($min ? $min : $max ) ? $max : '' );
        return (string) $storeys;
    }

    function get_features_price_group() {
        return $this->getField( 'building_features_price_group' );
    }

    function get_features_price_rating() {
        $rating = $this->formatString( $this->getField( 'building_features_price_rating' ) );
        return $rating ? $rating : 0;
    }

    function formatString( $string = '' ) {
        return (string) str_replace( '.', ',', (string) $string );
    }

}