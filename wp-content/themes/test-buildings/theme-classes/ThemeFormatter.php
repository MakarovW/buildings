<?php

trait ThemeFormatter {
    function formatString( $string ) {
        return (string) str_replace( '.', ',', (string) $string );
    }

    function formatFloat( $string ) {
        return (float) str_replace( ',', '.', (string) $string );
    }
}