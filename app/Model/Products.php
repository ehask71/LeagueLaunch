<?php

/**
 * CakePHP Products
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Products extends AppModel {

    public $primaryKey = 'id';

    public function getProductById($id) {
        if (($product = Cache::read('getProductById' . $id)) === false) {
            $product = $this->find('first', array('conditions' => array('Products.id' => $id, 'Products.site_id' => Configure::read('Settings.site_id'), 'Products.active' => 1)));
            Cache::write('getProductById' . $id, $product);
        }
        return $product;
    }

    public function getRegistrationProducts() {
        return $this->find('all', array(
                    'order' => 'Products.id DESC',
                    'conditions' => array(
                        'Products.site_id' => Configure::read('Settings.site_id'),
                        'Products.active' => 1,
                        'Products.category_id' => 1 
                        )));
    }

}

