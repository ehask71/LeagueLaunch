<?php

/**
 * CakePHP LayoutHelper
 * @author Eric
 */
App::uses('AppHelper', 'View/Helper');

class LayoutHelper extends AppHelper {

    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Js',
    );

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    public function beforeRender($viewFile) {
        
    }

    public function afterRender($viewFile) {
        
    }

    public function beforeLayout($viewLayout) {
        
    }

    public function afterLayout($viewLayout) {
        
    }

    public function isLoggedIn() {
        if ($this->Session->check('Auth.User.id')) {
            return true;
        } else {
            return false;
        }
    }

    public function sessionFlash() {
        $messages = $this->Session->read('Message');
        $output = '';
        if (is_array($messages)) {
            foreach (array_keys($messages) as $key) {
                $output .= $this->Session->flash($key);
            }
        }
        return $output;
    }

}
