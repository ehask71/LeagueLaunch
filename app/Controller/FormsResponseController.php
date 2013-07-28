<?php

/**
 * CakePHP FormsResponsesController
 * @author Eric
 */
//App::uses('AppController', 'Controller');
App::uses('FormsController', 'Controller');
App::import('Vendor', 'Formbuilder', array('file' => 'formbuilder.php'));
App::import('Vendor', 'Formbuilder', array('file' => 'php-excel.class.php'));

class FormsResponseController extends FormsController {

    public $name = 'FormsResponses';
    public $uses = array('FormsResponse');

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
                    $this->request->data['FormsResponse']['site_id'] = Configure::read('Settings.site_id');
                    $this->request->data['FormsResponse']['form_id'] = $id;
                    $this->request->data['FormsResponse']['content'] = serialize($results['results']);
                    if ($this->FormsResponse->save($this->request->data['FormsResponse'])) {
                        print_r($this->request->data['FormsResponse']);
                        Cache::delete('form_responses_' . $id);
                        if (!empty($forms['Forms']['send_responses_email'])) {
                            $Email = new CakeEmail();
                            $Email->viewVars(compact('forms'));
                            $contents = $results['results'];
                            $Email->viewVars(compact('contents'));
                            list($form_structure, $form_label) = $this->__unserializeFormStructure($form_structure);
                            $Email->viewVars(compact('form_label', 'form_structure'));

                            $Email->template('Survey.notify_new_respose');
                            $Email->emailFormat('html');
                            $Email->from(array('support@yoursite.com' => 'Your Site'));
                            $Email->to($forms['Forms']['send_responses_email']);
                            $Email->subject(__('New Survey Response'));
                            $Email->send();
                        }

                        if (isset($forms['Forms']['thankyou_url']) && !empty($forms['Forms']['thankyou_url'])):
                            $this->redirect($forms['Forms']['thankyou_url']);
                        elseif (isset($forms['Forms']['thankyou_content']) && !empty($forms['Forms']['thankyou_content'])):
                            $this->Session->write('FormsThankyouMessage', $forms['Forms']['thankyou_content']);
                            $this->redirect(array('controller' => 'forms', 'action' => 'thankyou'));
                       /* else:
                            $this->redirect(array('controller' => 'home', 'action' => 'index')); */
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
    
    function admin_view($id=null,$form_id=null){
        $response = $this->FormsResponse->getResponseById($id, $form_id);
        $responseList = null;
        $FormStructure = null;
        $FormLabel = null;
        if(!empty($response)){
            $id = $response['SurveyResponse']['id'];
            $responseList = $this->FormsResponse->getResponseList($response['FormsResponse']['form_id']);
            $formStructure = $response['Forms']['form_structure'];
            list($FormStructure, $FormLabel) = $this->__unserializeFormStructure($formStructure);

        }
        $this->set('form_structure', $FormStructure);
        $this->set('form_label', $FormLabel);
        $this->set('response', $response);
        $this->set('responseList', $responseList);
        $this->set('current_id', $id);
        $this->set('survey_id', $survey_id);
    }
    
    function admin_index($id) {
        if (!$id) {
            return false;
        }

        $this->set(compact('id'));


        if (($forms = Cache::read('get_forms_by_id_'.$id)) === false) {
            $forms = $this->FormsResponse->Forms->find('first', array('conditions'=>array('Forms.id'=>$id), 'fields'=>array('Forms.name', 'Forms.form_structure', 'Forms.survey_response_count')));
            Cache::write('get_forms_by_id_'.$id, $survey);
        }

        if(empty($forms)){
            return false;
        }

        if(!empty($forms)){
            $formStructure = $forms['Forms']['form_structure'];
            list($FormStructure, $FormLabel) = $this->__unserializeFormStructure($formStructure);
        }
        $this->set('form_structure', $FormStructure);
        $this->set('form_label', $FormLabel);
        $this->set('form', $forms);

        if (($forms_responses = Cache::read('forms_responses_'.$id)) === false) {
            $this->FormsResponse->unbindModel(array('belongsTo'=>array('Forms')), false);
            $forms_responses = $this->SurveyResponse->find('all', array('conditions'=>array('FormsResponse.survey_id'=>$id), 'order'=>array('FormsResponse.created'=> 'DESC'), 'fields'=>array()));
            $arrResponses = null;
            foreach($forms_responses as $forms_response):
                $responses = unserialize($forms_response['FormsResponse']['content']);

                $i=0;
                foreach($responses as $field => $value):
                    $label = (isset($FormLabel[$i]) && !empty($FormLabel[$i])) ? $FormLabel[$i] : sprintf(__('Undefined %s', true), ($i+1));
                    $arrResponses[$label][$forms_response['FormsResponse']['id']] = $value;
                    $i++;
                endforeach;
            endforeach;
            $forms_responses = $arrResponses;
            Cache::write('forms_responses_'.$id, $forms_responses);
        }
        $this->set('forms_responses', $forms_responses);
    }
}

