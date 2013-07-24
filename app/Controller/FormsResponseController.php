<?php

/**
 * CakePHP FormsResponsesController
 * @author Eric
 */
//App::uses('AppController', 'Controller');
App::import('Controller', 'FormsController');
App::import('Vendor', 'Formbuilder', array('file' => 'formbuilder.php'));
App::import('Vendor', 'Formbuilder', array('file' => 'php-excel.class.php'));

class FormsResponseController extends FormsController {

    public $name = 'FormsResponses';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('save_response');
    }

    public function index() {
        
    }

    public function save_response($id) {
        $this->autoRender = false;
        
        $this->loadModel('Forms');
        $forms = $this->Forms->getFormsById($id);
        $msg = ($forms['Forms']['error_message']) ? $forms['Forms']['error_message'] : __('Oops...something went wrong when trying to save your survey responses. Take a look at the errors below and try again.', true);
        if ($forms['Forms']['published'] == 0) {
            $this->redirect(array('action' => 'response', $id));
            return false;
        }

        $results = null;
        if ($this->request->is('post') || $this->request->is('put')) {
            //check validate captcha
            if ($this->MathCaptcha->validates($this->request->data['security_code'])) {
                $form_structure = $forms['Forms']['form_structure'];
                $form = new Formbuilder(unserialize($form_structure));
                $results = $form->process($this->request->data);
                if ($results['success'] == 1) {
                    $this->request->data['FormsResponse']['survey_id'] = $id;
                    $this->request->data['FormsResponse']['content'] = serialize($results['results']);
                    if ($this->FormsResponse->save($this->request->data['FormsResponse'])) {
                        Cache::delete('form_responses_' . $id);
                        if (!empty($survey['Forms']['send_responses_email'])) {
                            $Email = new CakeEmail();
                            $Email->viewVars(compact('forms'));
                            $contents = $results['results'];
                            $Email->viewVars(compact('contents'));
                            list($form_structure, $form_label) = $this->__unserializeFormStructure($form_structure);
                            $Email->viewVars(compact('form_label', 'form_structure'));

                            $Email->template('Survey.notify_new_respose');
                            $Email->emailFormat('html');
                            $Email->from(array('support@yoursite.com' => 'Your Site'));
                            $Email->to($survey['Forms']['send_responses_email']);
                            $Email->subject(__('New Survey Response'));
                            $Email->send();
                        }

                        if (isset($forms['Forms']['thankyou_url']) && !empty($forms['Forms']['thankyou_url'])):
                            $this->redirect($forms['Forms']['thankyou_url']);
                        elseif (isset($form['Forms']['thankyou_content']) && !empty($forms['Forms']['thankyou_content'])):
                            $this->Session->write('FormsThankyouMessage', $forms['Forms']['thankyou_content']);
                            $this->redirect(array('controller' => 'forms', 'action' => 'thankyou'));
                        endif;
                    }
                }
            }else {
                $this->Session->setFlash(__('Please enter the correct answer to the math question.', true), 'alert/error');
                $this->redirect(array('action' => 'response', $id));
            }
        }

        if (isset($results['errors']) && !empty($results['errors'])) {
            $this->Session->setFlash($msg, 'alert/error');
            $this->redirect(array('action' => 'response', $id));
        }
    }

}

