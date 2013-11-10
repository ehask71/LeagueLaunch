<?php

/**
 * CakePHP Attachment
 * @author EricMain
 */
App::uses('Model', 'Model');

class Attachment extends AppModel {
    
    public $name = 'Attachment';
    public $primaryKey = 'id';
    
   /* public $actsAs = array(
        'Upload.Upload' => array(
            'attachment' => array(
                'thumbnailSizes' => array(
                    'xvga' => '1024x768',
                    'vga' => '640x480',
                    'thumb' => '80x80',
                ),
            ),
        ),
    );
   
    public $belongsTo = array(
        'Properties' => array(
            'className' => 'Properties',
            'foreignKey' => 'foreign_key',
        ),
    );*/
}
