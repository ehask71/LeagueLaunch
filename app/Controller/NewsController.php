<?php
/**
 * CakePHP NewsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class NewsController extends AppController {

    public $uses = array('News');
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        $this->paginate = array(
	    'conditions' => array(
		'News.site_id' => Configure::read('Settings.site_id'),
                'and' => array(
                    array('News.start_date <= ' => date('Y-m-d H:i:s'),'News.end_date >= ' => date('Y-m-d H:i:s'))
                ),
                'News.is_active' => 'yes'
	    ) 
	);
        $news = $this->paginate('News');
        if(!empty($this->request->params['requested'])){
            return $news;
        }
        $this->set('title_for_layout','Latest News');
        $this->set('news',$news);
    }
    
    public function admin_index(){
	if ($this->request->is('post')) {
	    $this->News->set($this->data);
	    if ($this->News->newsValidate()) {
		$this->Divisions->save($this->request->data, false);
		$this->Session->setFlash(__('The Division was Added!'),'default',array('class'=>'alert succes_msg'));
		$this->redirect('/admin/divisions');
	    }
	}
	$this->paginate = array(
	    'conditions' => array(
		'News.site_id' => Configure::read('Settings.site_id'),
                'News.is_active' => 'yes'
	    ) 
	);
        $news = $this->paginate('News');
    }
    
}
