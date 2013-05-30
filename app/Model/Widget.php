<?php
/**
 * CakePHP Widget
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Widget extends AppModel {
    
    public function build(){
	echo 'Params'.print_r($this->params,1);
    }

}

