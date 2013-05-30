<?php
/**
 * CakePHP Widget
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Widget extends AppModel {
    
    public function build($controller,$action){
	echo $controller. ' ' . $action;
    }

}

