<?php
/**
 * CakePHP JsController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class JsbController extends AppController {
    
    public $name = 'Js';
    
    public function beforeFilter() {
	parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
    public function index(){
        $this->autoRender = false;
        echo '<html><head>
            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
            </head><body>';
        echo '<script type="text/javascript">';
	echo '$(parent.document).find(\'.ui-dialog\');';
	echo 'window.parent.$(\'#dialogIDname\').dialog(\'close\');'; 
        echo '</script></body></html>';
    }
    
}

