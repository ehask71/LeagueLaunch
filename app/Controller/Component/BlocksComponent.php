<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP BlocksComponent
 * @author EricMain
 */
class BlocksComponent extends Component {
    
    public $blocksForLayout = array();
    public $components = array();

    public function initialize($controller) {
        $this->controller = $controller;
        if (isset($controller->Block)) {
            $this->Block = $controller->Block;
        } else {
            $this->Block = ClassRegistry::init('Block');
        }
    }

    public function startup($controller) {
        if (!isset($controller->request->params['admin']) && !isset($controller->request->params['requested'])) {
            $this->blocks();
        }
    }

    public function beforeRender($controller) {
        $controller->set('blocks_for_layout', $this->blocksForLayout);
    }

    public function shutDown($controller) {
        
    }

    public function beforeRedirect($controller, $url, $status = null, $exit = true) {
        
    }
    
    public function blocks(){
        
    }

}
