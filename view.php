<?php

Class View {

    /**
     * Helper function to return the HTML for a drop-down selection list for
     * an array of countries
     */
    function country_list($countries, $current_country) {
        $result = '<select name="country">';
        foreach($countries as $country) {
            if ($country['Code'] == $current_country) {
                $selected = ' selected="selected"';
            }
            else {
                $selected = '';
            }
            $result .= sprintf('<option value = "%s"%s>%s</option>', 
                               $country['Code'], $selected, $country['Name']);
        }
        $result .= '</select>';
        return $result;
    }

    /**
     * Helper function to return the HTML table for a given cities array
     */
    function table_cities($cities) {
        $result = '<table id="cities">';
        $result .= '<thead><tr><td>Name</td><td>District</td><td>Population</td></tr></thead>';
        $result .= '<tbody>';
        
        foreach($cities as $city) {
            $result .= sprintf('<tr><td>%s</td><td>%s</td><td>%s</td></tr>', 
                    $city['Name'], $city['District'], $city['Population']);
        }
        
        $result .= '</tbody>';
        $result .= '</table>';
        
        return $result;

    }

    /**
     * Shows the main page
     */
    function index($countries, $cities, $form) {
    ?>

    <html>
    <head>
        <title>Test application for database world</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="index.php" method="POST">
            <!-- country selection -->
            Choose a country: 
            <?php echo $this->country_list($countries, $form['country']); ?>
            <!-- order -->
            Ordered by:
			<label>
            <input type="radio" name="ordered" value="Population" 
                <?php echo $form['ordered'] != "Name"?'checked = "checked"':''; ?>
                />Population
			</label>
			<label>
            <input type="radio" name="ordered" value="Name" 
                <?php echo $form['ordered'] == "Name"?'checked = "checked"':''; ?>
                />Name
			</label>
            <input type="submit" name="send" value="Show cities">
        </form>
        <!-- Cities table, if any results -->
        <?php if ($cities) { echo $this->table_cities($cities); } ?>
    </body>

    <?php
    }
}
