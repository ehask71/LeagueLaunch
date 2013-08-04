<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP LeagueAgeComponent
 * @author Eric
 */
class LeagueAgeComponent extends Component {

    public $components = array();
    public $birthdate = '';
    public $Sport = 'baseball';
    public $leagueAge = 99;
    public $divisor = array(
        'baseball' => '365.25'
    );

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, array_merge($this->settings, (array) $settings));
    }

    public function initialize($controller) {
        $this->Sport = Configure::read('Settings.sport');
    }

    public function startup($controller) {
        
    }

    public function calculateLeagueAge($birthdate) {

        $sport = (!isset($this->divisor[$this->Sport])) ? 'baseball' : $this->Sport;
        $now = date('Y-m-d');
        if(function_exists('date_diff')){
            $diff = date_diff(date_create($birthdate), date_create($now));
        } else {
            $diff = $this->date_diff($birthdate, $now);
        }

        return $diff / $this->divisor[$sport];
    }

    public function date_diff($date1, $date2) {
        $current = $date1;
        $datetime2 = date_create($date2);
        $count = 0;
        while (date_create($current) < $datetime2) {
            $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
            $count++;
        }
        return $count;
    }

}
