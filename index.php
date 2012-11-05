<?php
require_once('model.php');
require_once('view.php');

Class Controller {

    function index() {
        $model = new Model();

        if (!isset($_REQUEST['ordered'])) {
            $form['ordered'] = 'Population';
        }
        else {
            $form['ordered'] = $_REQUEST['ordered'];
        }
            
        if (isset($_REQUEST['country'])) {
            $form['country'] = $_REQUEST['country'];
            /* query for the list of cities */
            $cities = $model->get_country_cities($form['country'], 
                                                 $form['ordered']);
        }
        else {
            $form['country'] = 'AFG';
            $form['ordered'] = 'Population';
            $cities = NULL;
        }
        
        $countries = $model->get_all_countries();
        
        $view = new View();
        $view->index($countries, $cities, $form);
    }

}

$controller = new Controller();
$controller->index();