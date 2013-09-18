<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP RoundRobinComponent
 * @author Eric
 */
class RoundRobinComponent extends Component {

    public $components = array();

    /**
     * Is true when rounds have been created properly by using 'create_games()'
     * or 'create_raw_games()'
     *
     * Default value is false
     *
     * @access public
     * @var boolean
     */
    public $finished;

    /**
     * Holds the latest error message if there was one
     *
     * Default value is ''
     *
     * @access public
     * @var string
     */
    public $error;

    /**
     * Is true when the last action was a successful run of 'create_games'
     *
     * Default value is false
     *
     * @access public
     * @var boolean
     */
    public $gamedays_created;

    /**
     * Is true when the last action was a successful run of 'create_raw_games'
     *
     * Default value is false
     *
     * @access public
     * @var boolean
     */
    public $raw_games_created;

    /**
     * Holds a specific amount of match days. If set there will be this limited amout
     * of match days with random picks of the games.
     *
     * Default value is 0
     *
     * @access public
     * @var integer
     */
    public $gameday_count;

    /**
     * When there is an uneven number of teams, either one free ticket match per gameday can be created
     * or the match is ignored
     *
     * When true games against 'free_ticket' are created
     * If false those games will be excluded from the 'games' property
     *
     * Default value is true
     *
     * @access public
     * @var boolean
     */
    public $free_ticket;

    /**
     * Holds the string that identifies a free ticket
     *
     * Default value is 'free_ticket'
     *
     * @access public
     * @var string
     */
    public $free_ticket_identifer;

    /**
     * Holds the Pointer to the next match to be returned by next_match()
     *
     * Default value is 0
     *
     * @access private
     * @var integer
     */
    private $game_pointer;

    /**
     * Holds the Pointer to the next gameday to be returned by next_gameday()
     *
     * Default value is 0
     *
     * @access private
     * @var integer
     */
    private $gameday_pointer;

    /**
     * Holds the teams that play against each other
     *
     * Default value is null
     *
     * @access private
     * @var array
     */
    private $teams;

    /**
     * Holds one half of the teams that play against each other
     *
     * Default value is null
     *
     * @access private
     * @var array
     */
    private $teams_1;

    /**
     * Holds one half of the teams that play against each other
     *
     * Default value is null
     *
     * @access private
     * @var array
     */
    private $teams_2;

    /**
     * Holds the games with the teams that go against each other after
     * successfully executing 'create_round_robin()'
     *
     * A match is an array containing the 2 opponents.
     * A gameday is represented by an array of match arrays
     *
     * When 'create_games' called, $games contains an array of the gamedays
     * When 'create_raw_games' calles, $games contains an array of games
     *
     * Default value is an empty array
     *
     * @access public
     * @var array
     */
    public $games;

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, array_merge($this->settings, (array) $settings));
    }

    public function initialize($controller) {
        
    }

    public function startup($controller) {
        
    }

    /**
     * Constructor.
     *
     * If an array holding the teams got passed it assignes them to the
     * $teams property.
     *
     * If not the teams have to be passed by using the 'pass_teams()' function.
     *
     * @access public
     * @param array $passed_teams the teams which play
     */
    public function roundrobin($passed_teams = null) {
        $this->teams = $passed_teams;
        //default properties
        $this->finished = false;
        $this->error = '';
        $this->gamedays_created = false;
        $this->raw_games_created = false;
        $this->gameday_count = 0;
        $this->free_ticket = true;
        $this->free_ticket_identifer = 'Bye';
        $this->gameday_pointer = 0;
        $this->game_pointer = 0;
        $this->games = array();
    }

    /**
     * Alternative way to pass the teams (unlike with the contructor)
     *
     * @access public
     * @param array $passed_teams the teams which play
     * @return true
     */
    public function pass_teams($passed_teams) {
        $this->teams = $passed_teams;
        return true;
    }

    /**
     * Creates the games for the tournament which are stored in $games.
     *
     * Does not start if $teams isn't an array or empty.
     *
     * @access public
     * @return false when error occured or the $games array when successful;
     */
    public function create_games() {
        if (!$this->valid_team_array())
            return false;

        //clear $games
        $this->games = array();

        // create the two seperated arrays for the rotating algorithm
        if (count($this->teams) % 2) {
            // when uneven number of teams
            $this->teams_1 = array_slice($this->teams, 0, ceil(count($this->teams) / 2));
            $this->teams_2 = array_slice($this->teams, ceil(count($this->teams) / 2));
            $this->teams_2[] = $this->free_ticket_identifer;
        } else {
            $this->teams_1 = array_slice($this->teams, 0, count($this->teams) / 2);
            $this->teams_2 = array_slice($this->teams, count($this->teams) / 2);
        }

        //start rotating / saving
        if (!$this->gameday_count) {
            //no specific gameday count
            for ($i = 2; $i < (count($this->teams_1) * 2); $i++) {
                $this->save_gameday();
                $this->rotate();
            }
            $this->save_gameday();
        } else {
            if ($this->gameday_count < 0) {
                $this->error = 'No negative match day count allowed.';
                $this->reset_class_state();
                return true;
            }
            shuffle($this->teams_1);
            shuffle($this->teams_2);

            // test if we can create so many valid gamedays
            if (count($this->teams) >= $this->gameday_count) {
                for ($i = 1; $i < $this->gameday_count; $i++) {
                    $this->save_gameday();
                    $this->rotate();
                }
                $this->save_gameday();
            } else {
                for ($i = 2; $i < (count($this->teams_1) * 2); $i++) {
                    $this->save_gameday();
                    $this->rotate();
                }
                $this->save_gameday();
                // add extra blank days
                $diff = $this->gameday_count - count($this->teams);
                //$this->teams_2 = shuffle($this->teams_2);
                //mail('ehask71@gmail.com', 'Teams', print_r($this->teams_1, 1) . ' ' . print_r($this->teams_2, 1));
                for ($i = 0; $i < $diff; $i++) {
                    // $this->save_gameday();
                    //$this->rotate();
                }
            }
        }



        $this->finished = true;
        $this->raw_games_created = false;
        $this->gamedays_created = true;
        $this->clear_pointer();

        return $this->games;
    }

    /**
     * Inserts one gameday into the $games array
     *
     * Takes care if games with free tickets should be included
     *
     * @access private
     * @return true;
     */
    private function save_gameday() {
        for ($i = 0; $i < count($this->teams_1); $i++) {
            if ($this->free_ticket || ($this->teams_1[$i] != $this->free_ticket_identifer &&
                    $this->teams_2[$i] != $this->free_ticket_identifer))
                $games_tmp[] = array($this->teams_1[$i], $this->teams_2[$i]);
        }
        $this->games[] = $games_tmp;
        return true;
    }

    /**
     * Rotates the 2 opponent arrays $teams_1, $teams_2 to create the next gameday games
     *
     * Based on an algorithm described here: http://groups.google.com/group/net.works/msg/1f132ad5803e82a5
     *
     * @access private
     * @return true;
     */
    private function rotate() {
        $temp = $this->teams_1[1];
        for ($i = 1; $i < (count($this->teams_1) - 1); $i++) {
            $this->teams_1[$i] = $this->teams_1[$i + 1];
        }
        $this->teams_1[count($this->teams_1) - 1] = end($this->teams_2);
        for ($i = (count($this->teams_2) - 1); $i > 0; $i--) {
            $this->teams_2[$i] = $this->teams_2[$i - 1];
        }
        $this->teams_2[0] = $temp;
        return true;
    }

    /**
     * Creates games everybody against everybody without gamedays.
     * Free tickets will be ignored
     *
     * @access public
     * @return false when error occured, the match array when true
     */
    public function create_raw_games() {
        if (!$this->valid_team_array())
            return false;

        $this->games = array();

        for ($i = 0; $i < count($this->teams); $i++)
            for ($i2 = $i + 1; $i2 < count($this->teams); $i2++)
                $this->games[] = array($this->teams[$i], $this->teams[$i2]);

        $this->finished = true;
        $this->raw_games_created = true;
        $this->gamedays_created = false;
        $this->clear_pointer();

        return $this->games;
    }

    /**
     * Test whether $teams holds a valid array
     *
     * When an error occurs, the class goes back into start shape
     * This is probably the only error that might occure during a attempt
     * of generating games
     *
     * @access private
     * @return false when not, true when valid
     */
    private function valid_team_array() {
        if (!is_array($this->teams) || count($this->teams) < 2) {
            $this->error = 'Not enough teams in array shape passed';
            $this->reset_class_state();
            return false;
        }
        return true;
    }

    /**
     * Resets the class state variables
     *
     * @access private
     * @return true
     */
    public function reset_class_state() {
        // going back to start shape
        $this->finished = false;
        $this->raw_games_created = false;
        $this->gamedays_created = false;
        $this->games = array();
        $this->clear_pointer();
        $this->gameday_count = 0;
        return true;
    }

    /**
     * Clears the pointer to proceed in using the next() functions
     * after a new match generation
     *
     * @access private
     * @return true
     */
    private function clear_pointer() {
        $this->gameday_pointer = 0;
        $this->game_pointer = 0;
        return true;
    }

    /**
     * Returns the next match array  according to 'game_pointer'
     * When 'gamedays_created' is true it also refers to where '$gameday_pointer' is
     * If 'raw_games_created' is true, it simply returns the next array in games
     *
     * When there are no more games to return, false is returned
     *
     * @access public
     * @return array the match array or false
     */
    public function next_match() {
        if ($this->raw_games_created) {
            if (isset($this->games[$this->game_pointer])) {
                $this->game_pointer++;
                return $this->games[$this->game_pointer - 1];
            }
            else
                return false;
        }
        elseif ($this->gamedays_created) {
            if (isset($this->games[$this->gameday_pointer - 1][$this->game_pointer])) {
                $this->game_pointer++;
                return $this->games[$this->gameday_pointer - 1][$this->game_pointer - 1];
            }
            else
                return false;
        }
        else {
            $this->error = 'No games created yet.';
            return false;
        }
    }

    /**
     * Returns the next gameday array  according to 'gameday_pointer'
     *
     * When there are no more gamedays to return, false is returned
     *
     * @access public
     * @return array the gameday array or false
     */
    public function next_gameday() {
        if ($this->raw_games_created) {
            $this->error = "No gamedays created within last action.";
            return false;
        } elseif ($this->gamedays_created) {
            if (isset($this->games[$this->gameday_pointer])) {
                $this->gameday_pointer++;
                $this->game_pointer = 0;
                return $this->games[$this->gameday_pointer - 1];
            }
            else
                return false;
        }
        else {
            $this->error = 'No games created yet.';
            return false;
        }
    }

    public function createRandom() {
        $teams = $_GET['t'];
        $games = array();   //2D array tracking which week teams will be playing
// do the work
        for ($i = 1; $i <= $teams; $i++) {
            $games[$i] = array();
            for ($j = 1; $j <= $teams; $j++) {
                $games[$i][$j] = getweek($i, $j, $teams);
            }
        }

// display
        echo '<pre>';
        $max = 0;
        foreach ($games as $row) {
            foreach ($row as $col) {
                printf('%4d', is_null($col) ? -2 : $col);
                if ($col > $max) {
                    $max = $col;
                }
            }
            echo "\n";
        }
    }

    public function getWeek($home, $away, $num_teams) {
        if ($home == $away) {
            return -1;
        }
        $week = $home + $away - 2;
        if ($week >= $num_teams) {
            $week = $week - $num_teams + 1;
        }
        if ($home > $away) {
            $week += $num_teams - 1;
        }

        return $week;
    }

    /**
     * Rotates an array for the round robin algorithm
     */
    function round_robin_array($array) {
        // we always keep index 0
        $top = array_shift($array);
        $last = array_pop($array);
        $rotate = [$last];
        foreach ($array as $_value) {
            $rotate[] = $_value;
        }
        array_unshift($rotate, $top);
        return $rotate;
    }

    /**
     * Runs a round robin to make a schedule.
     */
    function round_robin($players, $weeks) {
        $schedule = [];
        $count = count($players);
        foreach ($players as $_p) {
            $schedule[$_p] = array_fill(0, $weeks, []);
        }
        for ($i = 0; $i < $weeks; $i++) {
            for ($a = 0; $a < ($count / 2) + 1; $a++) {
                $vs = $players[$a];
                $opp = $players[($count - $a) - 1];
                $at = rand(0, 1);
                $pg = [$opp, $at];
                $og = [$vs, $at];
                $schedule[$vs][$i] = $pg;
                $schedule[$opp][$i] = $og;
            }
            $players = $this->round_robin_array($players);
        }
        return $schedule;
    }

    function getFixtures($teamslist, $startDate, $referees) {
        //if odd number of teams add a BYE team! 
        if (count($teamslist) % 2 != 0) {
            array_push($teamslist, "BYE");
	    $odd = true;
        }

        //shuffle the list of teams, so we don't get same fixtures each time! 
        shuffle($teamslist);
        //split teamslist into two arrays 
        $away = array_splice($teamslist, (count($teamslist) / 2));
        $home = $teamslist;
	if($odd){
	    echo ((count($teamslist) + count($away))+1) * 2;
	} else {
	    echo ((count($teamslist) + count($away))-1) * 2;
	}
        //iterate through for every game in every round for teams 
        for ($a = 0; $a < ((count($teamslist) + count($away))-1) * 2; $a++) {
            //assign the full list of referees each round or week so we get full list again 
            $refs = $referees;
            //shuffle the list so its random 
            shuffle($refs);
            for ($z = 0; $z < count($home); $z++) {
                //pick a ref for a game basically! 
                $picked = array_shift($refs);
                //assign the relevant teams, dates, times and referee to fixtures 
                if (($a % 2 != 0) && ($z % 2 == 0)) {

                    if ($z % 2 == 0) {
                        $startDate = date('Y-m-d', strtotime($startDate . "+1 days"));
                    }
                    $match[$a][$z]["Home"] = $away[$z];
                    $match[$a][$z]["Away"] = $home[$z];
                    //$match[$a][$z]["Date"] = $startDate;
                    //$match[$a][$z]["Time"] = "19:00:00";
                    //$match[$a][$z]["Ref"] = $picked;
                } else {
                    if ($z % 2 == 0) {
                        $startDate = date('Y-m-d', strtotime($startDate . "+1 days"));
                    }
                    $match[$a][$z]["Home"] = $home[$z];
                    $match[$a][$z]["Away"] = $away[$z];
                    //$match[$a][$z]["Date"] = $startDate;
                    //$match[$a][$z]["Time"] = "19:00:00";
                    //$match[$a][$z]["Ref"] = $picked;
                }
            }

            //If there 
            if (count($home) + count($away) - 1 > 2) {
                $splice = array_splice($home, 1, 1);
                $shift = array_shift($splice);
                array_unshift($away, $shift);
                array_push($home, array_pop($away));
            }
            $startDate = date('Y-m-d', strtotime($startDate . "+7 days"));
        }
        //go through the whole array storing everything and go to each round, then game and check whether our bye team is present, if so ignore and remove the fixture,else keep it 
        foreach ($match AS $matchkey => $matchval) {

            foreach ($matchval AS $gamekey => $game) {
               // if ($game["Home"] != "IGNORE" && $game["Away"] != "IGNORE") {

                    //store it all in a new multidimensional array  
                    $allmatches[$matchkey][$gamekey] = $game;
                //}
            }
        }

//return it all 
        return $allmatches;
    }

}
