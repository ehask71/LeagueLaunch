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
        if (function_exists('date_diff')) {
            $diff = date_diff(date_create($birthdate), date_create($now));
        } else {
            $diff = $this->date_diff($birthdate, $now);
        }

        return $diff / $this->divisor[$sport];
    }

    public function limitAgeBasedOptions($players, $options) {
        $play = array();
        if (count($players) > 0) {
            $error = false;
            foreach ($players AS $row) {
                $league_age = $row['Players']['league_age'];
                if ($league_age == 0) {
                    if ($row['Players']['birthday'] != '') {
                        $league_age = $this->calculateLeagueAge($row['Players']['birthday']);
                    } else {
                        $error = true;
                    }
                }
                $row['Players']['registration_options'] = array('' => 'Please Select An Option');
                foreach ($options AS $opts) {
                    if (Configure::read('Settings.leagueage.use_leagueage') == 'true') {
                        if (!$error) {
                            $ages = explode(",", $opts['Divisions']['age']);
                            if (count($ages) > 0) {
                                if (in_array($league_age, $ages)) {
                                    $row['Players']['registration_options'][$opts['Divisions']['division_id']] = $opts['Divisions']['name'] . ' ($' . $opts['Products']['price'] . ')';
                                }
                            } else {
                                $row['Players']['registration_options'][$opts['Divisions']['division_id']] = $opts['Divisions']['name'] . ' ($' . $opts['Products']['price'] . ')';
                            }
                        } else {
                            if (Configure::read('Settings.leagueage.allow_on_error') == 'true') {
                                $row['Players']['registration_options'][$opts['Divisions']['division_id']] = $opts['Divisions']['name'] . ' ($' . $opts['Products']['price'] . ')';
                            } else {
                                $row['Players']['registration_options'][NULL] = 'Unable To Calulate Age';
                            }
                        }
                    } else {
                        $row['Players']['registration_options'][$opts['Divisions']['division_id']] = $opts['Divisions']['name'] . ' ($' . $opts['Products']['price'] . ')';
                    }
                }
                if(count($row['Players']['registration_options']) == 0){
                    $row['Players']['registration_options'][NULL] = 'No Available Registrations';
                }
                $play[] = $row;
            }
        }

        return $play;
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
