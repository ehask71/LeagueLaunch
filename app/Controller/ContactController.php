<?php
/**
 * CakePHP ContactController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class ContactController extends AppController {

    public function index(){
        $this->set('title_for_layout','Contact Us');
    }
    
}
