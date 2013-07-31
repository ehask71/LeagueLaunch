<?php
/**
 * CakePHP ProductCategory
 * @author Eric
 */
App::uses('AppModel', 'Model');

class ProductsCategory extends AppModel {
    
    public $primaryKey = 'id';
    
     public $useTable = 'product_categories';
     
}

