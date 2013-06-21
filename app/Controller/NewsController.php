<?php
/**
 * CakePHP NewsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class NewsController extends AppController {

    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        $this->paginate = array(
	    'conditions' => array(
		'News.site_id' => Configure::read('Settings.site_id')
	    ) 
	);
        $news = $this->paginate('News');
        if(!empty($this->request->params['requested'])){
            return $news;
        }
        $this->set('title_for_layout','Latest News');
        $this->set('news',$news);
    }
    
}
