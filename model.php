<?php
require_once('config.php');

class Model {

    /** 
     * Obtain all the cities from a given country, ordered by name or 
     * population. It returns an array with names, districts and populations.
     */
    function get_country_cities($country, $ordered = 'Population') {
        //$result[0] = array( 'name'       => 'Zaragoza', 'district'   => 'Aragon', 'population' => 768000);

		$result = $this->query('select * from City order by '. $ordered);
        
        return $result; 
    }

    /**
     * Get a list of all countries and theirs country codes.
     */
    function get_all_countries() {
          
        //$result[0] = array( 'Code' => 'ESP', 'Name'  => 'Spain');
        $result = $this->query('select * from Country');
        
        return $result;
    }


	function query($sql){
		global $host, $user, $password, $database;

		$r = array();

		$conn = mysql_connect($host, $user, $password);
		
		if (!$conn) {
			echo "Unable to connect to DB: " . mysql_error();
			exit;
		}

		if (!mysql_select_db($database)) {
			echo "Unable to select mydbname: " . mysql_error();
			exit;
		}

		$result = mysql_query($sql);
		if (!$result) {
			echo "Could not successfully run query ($sql) from DB: " . mysql_error();
			exit;
		}

		while ($row = mysql_fetch_assoc($result)) {
			array_push($r,$row);
		}

		mysql_free_result($result);

		mysql_close($conn);

		return $r;

	}



}

