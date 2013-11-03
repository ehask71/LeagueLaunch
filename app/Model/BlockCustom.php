<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * CakePHP BlockCustom
 * @author EricMain
 */
App::uses('Model', 'Model');

class BlockCustomModel extends Model {
    
    public $name = 'BlockCustom';
    public $primaryKey = 'id';
    public $useTable = 'blocks_custom';
   

}
