<?php
require_once('config.php');

class Model {

    /** 
     * Obtain all the cities from a given country, ordered by name or 
     * population. It returns an array with names, districts and populations.
     */
    function get_country_cities($country, $ordered = 'Population') {
          //change this code
        $result[0] = array(
            'name'       => 'Zaragoza', 
            'district'   => 'Aragon', 
            'population' => 768000
        );
        
        return $result; 
    }

    /**
     * Get a list of all countries and theirs country codes.
     */
    function get_all_countries() {
          //change this code
        $result[0] = array(
            'Code' => 'ESP', 
            'Name'  => 'Spain'
        );
        
        return $result;
    }
}