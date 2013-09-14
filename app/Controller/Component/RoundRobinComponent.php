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

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, array_merge($this->settings, (array) $settings));
    }
    
    public function initialize($controller) {
        
    }

    public function startup($controller) {
        
    }
    

}
