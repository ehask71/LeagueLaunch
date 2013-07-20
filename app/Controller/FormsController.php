<?php
/**
 * CakePHP FormsController
 * @author Eric
 */
App::uses('AppController', 'Controller');
require_once(APP.'Vendor'.DS.'Formbuilder/Formbuilder.php');

class FormsController extends AppController {
    
    public $uses = array('Forms');
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
    public function admin_index(){
        $this->paginate = array(
	    'conditions' => array(
		'Forms.site_id' => Configure::read('Settings.site_id')
	    ) 
	);
        $forms = $this->paginate('Forms');
	$this->set('title_for_layout',__('Forms'));
        $this->set('forms',$forms);
    }
    
    public function admin_new(){
        if ($this->request->is('post')) {
            /*require_once(APP.'Vendor'.DS.'Formbuilder/Formbuilder.php');
	    $builder = new Formbuilder($this->request->data);
            $this->Forms->save($builder)or die(mysql_error());
            $this->Session->setFlash(__('The Form was Added!'),'default',array('class'=>'alert succes_msg'));
	    */
            mail('ehask71@gmail.com','Form Save',print_r($this->request->data,1));
            
            $this->redirect('/admin/forms');
	}
    }
    
    public function admin_load($id){
	$this->autoRender = false;
        
        if ($this->RequestHandler->isAjax()) {
            $formStructure = $this->Forms->field('Forms.form_structure', array('Forms.id' => $id,'Forms.site_id' => Configure::read('Settings.site_id')));
            $formStructure = unserialize($formStructure);
            $form = new Formbuilder($formStructure);
            $form->render_json();
        }

        return false;
    }
    
    public function admin_save($id=null){
        $this->autoRender = false;
	if ($this->request->is('post') || $this->request->is('put')) {
            $form_structure = json_decode($this->request->data['Forms']['form_structure'], true);
            $params['form']['frmb'] = $form_structure['frmb'];
            $form = new Formbuilder($params['form']);
            $for_db = $form->get_encoded_form_array();

            if($id){
                $this->request->data['Forms']['id'] = $id;
            }
	    //$this->request->data['Forms']['site_id'] = Configure::read('Settings.site_id');
            //$this->request->data['Forms']['form_structure'] = serialize($for_db);
            if ($this->Forms->save($this->request->data)) {
                $ID = ($this->Forms->getLastInsertID()) ? $this->Forms->getLastInsertID() :   $this->Forms->id;
                return $ID;
            }
            return true;
        }
        return false;
    }
    
    public function admin_edit($id=null){
        if (!$id) {
            return false;
        }
        $this->set(compact('id'));

        if ($this->request->is('post') || $this->request->is('put')) {
            $text_logo = $this->request->data['Survey']['text_or_logo'];
            if($text_logo == 'header_text'){
                @unlink(WWW_ROOT.'/files/surveys/'.$this->request->data['Survey']['header_logo_dir'].'/'.$this->request->data['Survey']['logo']);
                $this->request->data['Survey']['header_logo_dir'] = null;
                $this->request->data['Survey']['header_logo'] = null;
            }

            $thankyou = $this->request->data['Survey']['thankyou'];
            if($thankyou=='thankyou_content'){
                $this->request->data['Survey']['thankyou_url'] = null;
            }

            if ($this->Survey->save($this->request->data)) {
                $this->redirect('index');
            }
        } else {
            $this->request->data = $this->Survey->find('first', array('conditions'=>array('Survey.id'=>$id)));
        }
    }
}

