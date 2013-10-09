<?php
/**
 * CakePHP ScheduleController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class ScheduleController extends AppController {
    
    public $name = 'Schedule';
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        
    }
    
    public function admin_index($id=NULL) {
	if($id==null){
	    $this->Session->setFlash(__('Missing Season Id'));
	    $this->redirect('/admin/season');
	}
    }
    
}

