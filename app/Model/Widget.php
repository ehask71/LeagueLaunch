<?php
/**
 * CakePHP Widget
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Widget extends AppModel {
    
    public function build($prefix,$controller,$action){
	//echo $controller. ' ' . $action;
	//mail('ehask71@gmail.com','Widget Loader',$prefix.' '.$controller.' '.$action);
    }

}

