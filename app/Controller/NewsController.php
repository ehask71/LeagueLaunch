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
	    ),
	    'order' => array(
		'News.created' => 'desc'
	    )
	);
        $news = $this->paginate('News');
        if(!empty($this->request->params['requested'])){
            return $news;
        }
        $this->set('title_for_layout',__('Latest News'));
        $this->set('news',$news);
    }
    
    public function admin_index(){
	$this->paginate = array(
	    'conditions' => array(
		'News.site_id' => Configure::read('Settings.site_id')
	    ) 
	);
        $news = $this->paginate('News');
	$this->set('title_for_layout',__('News'));
        $this->set('news',$news);
    }
    
    public function admin_new(){
	if ($this->request->is('post')) {
	    $this->News->set($this->data);
	    if ($this->News->newsValidate()) {
		$this->News->save($this->request->data, false);
		$this->Session->setFlash(__('The News Article was Added!'),'default',array('class'=>'alert succes_msg'));
		$this->redirect('/admin/news');
	    }
	}
	
    }
    
    public function admin_edit($id){
	$new = $this->News->find('first',array('conditions' => array(
	    'News.id'=>$id,
	    'News.site_id'=> Configure::read('Settings.site_id')
	    )));
	if(empty($new)){
	    $this->Session->setFlash(__('News Item doesn\'t Exist'),'default',array('class'=>'alert error_msg'));
	    $this->redirect('/admin/news');
	}
	if($this->request->isPut()){
	    $this->News->set($this->data);
	    if ($this->News->newsValidate()) {
		$this->News->save($this->request->data, false);
		$this->Session->setFlash(__('The News Item was Updated!'),'default',array('class'=>'alert succes_msg'));
		$this->redirect('/admin/news');
	    }
	} else {
	    //$new = $this->News->find('first',array('conditions' => array('News.id'=>$id)));
	    $this->request->data = null;
	    if(!empty($new)){
		$this->request->data = $new;
	    }
	}
    }
    
}
