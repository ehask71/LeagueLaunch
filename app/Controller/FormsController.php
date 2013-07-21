<?php

/**
 * CakePHP FormsController
 * @author Eric
 */
App::uses('AppController', 'Controller');
require_once(APP . 'Vendor' . DS . 'Formbuilder/Formbuilder.php');

class FormsController extends AppController {

    public $uses = array('Forms');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        
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
            $this->Forms->id = $this->request->data['Forms']['id'];
            if ($this->Forms->save($this->request->data)) {
                mail('ehask71@gmail.com', 'Form Save', print_r($this->request->data, 1));
                $this->redirect('/admin/forms');
            }
        }
    }

    public function admin_load($id=NULL) {
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
            //$this->request->data['Forms']['site_id'] = Configure::read('Settings.site_id');
            //$this->request->data['Forms']['form_structure'] = serialize($for_db);
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
            /* $text_logo = $this->request->data['Forms']['text_or_logo'];
              if ($text_logo == 'header_text') {
              @unlink(WWW_ROOT . '/files/surveys/' . $this->request->data['Survey']['header_logo_dir'] . '/' . $this->request->data['Survey']['logo']);
              $this->request->data['Survey']['header_logo_dir'] = null;
              $this->request->data['Survey']['header_logo'] = null;
              }

              $thankyou = $this->request->data['Survey']['thankyou'];
              if ($thankyou == 'thankyou_content') {
              $this->request->data['Survey']['thankyou_url'] = null;
              }
             */
            if ($this->Forms->save($this->request->data)) {
                $this->redirect('/admin/forms');
            }
        } else {
            $this->request->data = $this->Forms->find('first', array('conditions' => array('Forms.id' => $id, 'Forms.site_id' => Configure::read('Settings.site_id'))));
        }
    }

    public function admin_preview($id) {
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
                $form->setControlPerPage($survey['Forms']['controls_per_page']);
                $this->set('renderHTML', $form->render_html('save_form', $forms, $results));
            } else {
                if (isset($this->request->data['Forms']['design']) && !empty($this->request->data['Forms']['design'])) {
                    $params = json_decode($this->request->data['Forms']['design'], true);
                    $form = new Formbuilder($params);
                    $for_db = $form->get_encoded_form_array();
                    $form = new Formbuilder($for_db);
                    $form->setMessage($msg);
                    $form->setControlPerPage($forms['Forms']['controls_per_page']);
                    $form->setPreviewState(true);
                    $this->set('renderHTML', $form->render_html('/surveys/save_response/' . $id, $forms, $results));
                }
            }
        } else {
            if ($forms) {
                $formStructure = unserialize($forms['Forms']['form_structure']);
                $form = new Formbuilder($formStructure);
                $form->setMessage($msg);
                $form->setControlPerPage($forms['Forms']['controls_per_page']);
                $this->set('renderHTML', $form->render_html(FULL_BASE_URL . $this->base . '/survey/survey_responses/save_response/' . $id, $forms, $results));
            } else {
                $this->set('renderHTML', null);
            }
        }
    }

}

