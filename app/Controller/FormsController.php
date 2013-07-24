<?php

/**
 * CakePHP FormsController
 * @author Eric
 */
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
require_once(APP . 'Vendor' . DS . 'Formbuilder/Formbuilder.php');

class FormsController extends AppController {

    public $uses = array('Forms','FormsResponse');
    public $components = array('MathCaptcha','RequestHandler', 'Cookie');

    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('view','preview','captcha');
    }

    public function index() {
	
    }

    public function view($id = null) {
	if (!$id) {
	    return false;
	}

	$form = $this->Forms->getFormsById($id);
	$msg = ($form['Forms']['error_message']) ? $form['Forms']['error_message'] : __('Oops...something went wrong when trying to save your form. Take a look at the errors below and try again.', true);
	if ($form['Forms']['published'] == 0) {
	    $this->layout = 'ajax';
	    $this->render('unpublished_survey');
	    return false;
	}

	if ($id) {
	    $results = (isset($results)) ? $results : null;
	    if (isset($results['errors']) && !empty($results['errors'])) {
		$this->Session->setFlash($msg, 'alert/error');
	    }
	    $this->admin_preview($id, $results, true);
	}
	$this->render('preview');
    }

    public function thankyou($survey=null){
        //$this->layout = 'Survey.survey';
    }
    
    public function admin_index() {
	$this->paginate = array(
	    'conditions' => array(
		'Forms.site_id' => Configure::read('Settings.site_id')
	    )
	);
	$forms = $this->paginate('Forms');
	$this->set('title_for_layout', __('Forms'));
	$this->set('forms', $forms);
    }

    public function admin_new() {
	if ($this->request->is('post') || $this->request->is('put')) {
	    $this->request->data['Forms']['name'] = (isset($this->request->data['Forms']['name']) && !empty($this->request->data['Forms']['name'])) ? $this->request->data['Forms']['name'] : __('Untitled', true);
	    $this->request->data['Forms']['id'] = trim($this->request->data['Forms']['id']);
	    $this->request->data['Forms']['site_id'] = Configure::read('Settings.site_id');
	    $this->Forms->id = $this->request->data['Forms']['id'];
	    if ($this->Forms->save($this->request->data)) {
		$this->redirect('/admin/forms');
	    }
	}
    }

    public function admin_load($id = NULL) {
	$this->autoRender = false;
	if ($this->RequestHandler->isAjax()) {
	    $formStructure = $this->Forms->field('Forms.form_structure', array('Forms.id' => $id, 'Forms.site_id' => Configure::read('Settings.site_id')));
	    $formStructure = unserialize($formStructure);
	    $form = new Formbuilder($formStructure);
	    $form->render_json();
	}
	return false;
    }

    public function admin_save($id = null) {
	$this->autoRender = false;
	if ($this->request->is('post') || $this->request->is('put')) {
	    $form_structure = json_decode($this->request->data['Forms']['form_structure'], true);
	    $params['form']['frmb'] = $form_structure['frmb'];
	    $form = new Formbuilder($params['form']);
	    $for_db = $form->get_encoded_form_array();

	    if ($id) {
		$this->request->data['Forms']['id'] = $id;
	    }
	    $this->request->data['Forms']['site_id'] = Configure::read('Settings.site_id');
	    $this->request->data['Forms']['form_structure'] = serialize($for_db);
	    if ($this->Forms->save($this->request->data)) {
		$ID = ($this->Forms->getLastInsertID()) ? $this->Forms->getLastInsertID() : $this->Forms->id;
		return $ID;
	    }
	    return true;
	}
	return false;
    }

    public function admin_edit($id = null) {
	if (!$id) {
	    return false;
	}
	$this->set(compact('id'));

	if ($this->request->is('post') || $this->request->is('put')) {
	    if ($this->Forms->save($this->request->data)) {
		$this->redirect('/admin/forms');
	    }
	} else {
	    $this->request->data = $this->Forms->find('first', array('conditions' => array('Forms.id' => $id, 'Forms.site_id' => Configure::read('Settings.site_id'))));
	}
    }
    
    public function preview($id, $results=null, $skipPreview=false){
	if ($this->RequestHandler->isAjax()) {
	    $this->autoRender = false;
	    //preview settings
	    if (isset($this->request->data['Forms']) && !empty($this->request->data['Forms'])) {
		$this->Session->write('Preview.Design', $this->request->data['Forms']);
		return true;
	    }
	}

	$forms = null;
	if ($id) {
	    $forms = $this->Forms->getFormsById($id);
	}
	$msg = ($forms['Forms']['error_message']) ? $forms['Forms']['error_message'] : __('Oops...something went wrong when trying to save your Form responses. Take a look at the errors below and try again.', true);

	$this->set(compact('forms', 'id'));

	if ($this->Session->check('Preview') && !$skipPreview) {
	    $forms['Forms'] = $this->Session->read('Preview.Design');
	    $this->set(compact('forms'));

	    $this->request->data['Forms'] = $this->Session->read('Preview.Design');
	}

	if (!empty($this->request->data)) {
	    $params = null;
	    if (isset($this->request->data['Forms']['frmb']) && !empty($this->request->data['Forms']['frmb'])) {
		$params = unserialize($this->request->data['Forms']['frmb']);
		$form = new Formbuilder($params);
		$form->setMessage($msg);
		//$form->setControlPerPage($survey['Forms']['controls_per_page']);
		$this->set('renderForm', $form->render_html('save_form', $forms, $results));
	    } else {
		if (isset($this->request->data['Forms']['design']) && !empty($this->request->data['Forms']['design'])) {
		    $params = json_decode($this->request->data['Forms']['design'], true);
		    $form = new Formbuilder($params);
		    $for_db = $form->get_encoded_form_array();
		    $form = new Formbuilder($for_db);
		    $form->setMessage($msg);
		    //$form->setControlPerPage($forms['Forms']['controls_per_page']);
		    $form->setPreviewState(true);
		    $this->set('renderForm', $form->render_html('/surveys/save_response/' . $id, $forms, $results));
		}
	    }
	} else {
	    if ($forms) {
		$formStructure = unserialize($forms['Forms']['form_structure']);
		$form = new Formbuilder($formStructure);
		$form->setMessage($msg);
		//$form->setControlPerPage($forms['Forms']['controls_per_page']);
		$this->set('renderForm', $form->render_html(FULL_BASE_URL . $this->base . '/survey/survey_responses/save_response/' . $id, $forms, $results));
	    } else {
		$this->set('renderForm', null);
	    }
	}
    }
    
    public function admin_preview($id, $results=null, $skipPreview=false) {
	if ($this->RequestHandler->isAjax()) {
	    $this->autoRender = false;
	    //preview settings
	    if (isset($this->request->data['Forms']) && !empty($this->request->data['Forms'])) {
		$this->Session->write('Preview.Design', $this->request->data['Forms']);
		return true;
	    }
	}

	$forms = null;
	if ($id) {
	    $forms = $this->Forms->getFormsById($id);
	}
	$msg = ($forms['Forms']['error_message']) ? $forms['Forms']['error_message'] : __('Oops...something went wrong when trying to save your Form responses. Take a look at the errors below and try again.', true);

	$this->set(compact('forms', 'id'));

	if ($this->Session->check('Preview') && !$skipPreview) {
	    $forms['Forms'] = $this->Session->read('Preview.Design');
	    $this->set(compact('forms'));

	    $this->request->data['Forms'] = $this->Session->read('Preview.Design');
	}

	if (!empty($this->request->data)) {
	    $params = null;
	    if (isset($this->request->data['Forms']['frmb']) && !empty($this->request->data['Forms']['frmb'])) {
		$params = unserialize($this->request->data['Forms']['frmb']);
		$form = new Formbuilder($params);
		$form->setMessage($msg);
		//$form->setControlPerPage($survey['Forms']['controls_per_page']);
		$this->set('renderForm', $form->render_html('save_form', $forms, $results));
	    } else {
		if (isset($this->request->data['Forms']['design']) && !empty($this->request->data['Forms']['design'])) {
		    $params = json_decode($this->request->data['Forms']['design'], true);
		    $form = new Formbuilder($params);
		    $for_db = $form->get_encoded_form_array();
		    $form = new Formbuilder($for_db);
		    $form->setMessage($msg);
		    //$form->setControlPerPage($forms['Forms']['controls_per_page']);
		    $form->setPreviewState(true);
		    $this->set('renderForm', $form->render_html('/surveys/save_response/' . $id, $forms, $results));
		}
	    }
	} else {
	    if ($forms) {
		$formStructure = unserialize($forms['Forms']['form_structure']);
		$form = new Formbuilder($formStructure);
		$form->setMessage($msg);
		//$form->setControlPerPage($forms['Forms']['controls_per_page']);
		$this->set('renderForm', $form->render_html(FULL_BASE_URL . $this->base . '/survey/survey_responses/save_response/' . $id, $forms, $results));
	    } else {
		$this->set('renderForm', null);
	    }
	}
    }
    
    public function captcha($checkValue=false){
        $this->autoRender = false;
        if(!$checkValue){
            return $this->MathCaptcha->generateEquation();
        }else{
            return $this->MathCaptcha->validates($checkValue);
        }
    }

}

