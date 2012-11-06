<?php
require_once('config.php');

class Model {

	var $pool;

	function Model() {
		$this->pool = array();
	}

    /** 
     * Obtain all the cities from a given country, ordered by name or 
     * population. It returns an array with names, districts and populations.
     */
    function get_country_cities($country, $ordered = 'Population') {
        //$result[0] = array( 'name'       => 'Zaragoza', 'district'   => 'Aragon', 'population' => 768000);

		$result = $this->query('select * from City order by '. $ordered . ' asc');
        
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
		$r = array();

		$conn = $this->get_connection();


		$result = mysql_query($sql);
		if (!$result) {
			echo "Could not successfully run query ($sql) from DB: " . mysql_error();
			exit;
		}

		while ($row = mysql_fetch_assoc($result)) {
			array_push($r,$row);
		}

		mysql_free_result($result);

		//mysql_close($conn);
		$this->release_connection($conn);

		return $r;

	}


	function get_connection(){
		global $host, $user, $password, $database;

		print "<!-- New Conection -->\n";
		$conn = array_pop($this->pool);

		if (!$conn) {
			$conn = mysql_connect($host, $user, $password);
		}
		
		if (!$conn) {
			echo "Unable to connect to DB: " . mysql_error();
			exit;
		}

		if (!mysql_select_db($database)) {
			echo "Unable to select mydbname: " . mysql_error();
			exit;
		}

		return $conn;
	}

	function release_connection($conn){
		print "<!-- Conection Released -->\n";
		array_push($this->pool, $conn);
	}



	function __destruct() {
		print "<!-- Destroying pool of " . count($this->pool) . " -->\n";
		foreach($this->pool as $conn) {
			mysql_close($conn);
		}
	}


}

