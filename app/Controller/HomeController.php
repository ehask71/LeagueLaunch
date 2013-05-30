<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {
    
    public $name = 'Home';
    
    public function index(){
        $this->render();
    }
    
    public function notconfigured(){
        
    }
}

?>
