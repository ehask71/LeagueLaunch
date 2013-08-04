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
        $this->birtdate = $birthdate;
        $sport = (!isset($this->divisor[$this->Sport]))?'baseball':$this->Sport;
        $now = date('Y-m-d');
        $diff = date_diff(date_create($this->birthdate), date_create($now));
        
        $this->leagueAge = $diff/$this->divisor[$sport];
        
        return $this->leagueAge;
    }

}
