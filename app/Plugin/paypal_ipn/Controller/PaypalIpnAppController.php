<?php
class PaypalIpnAppController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('process');
    }
}
?>