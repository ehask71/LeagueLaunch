<?php

App::uses('AppModel', 'Model');

/**
 * Description of TblSites
 *
 * @author Eric
 */
class Sites extends AppModel {

    public $useTable = 'sites';
    public $primaryKey = 'site_id';
    public $hasMany = 'Settings';

    public function getSiteId($domain) {
        $sql = "SELECT * FROM sites WHERE domain = '$domain' AND isactive = 'yes'";
        $res = $this->query($sql);

        if (count($res) > 0) {
            return $res;
        } else {
            return FALSE;
        }
    }

    public function siteValidate() {
        $validate1 = array(
            'leaguename' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s Name')
            ),
            'sport' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Select Your League\'s Sport')
            ),
            'firstname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter your First Name')
            ),
            'lastname' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter your Last Name')
            ),
            'email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s Email'),
                'mustBeEmail' => array(
                    'rule' => array('email'),
                    'message' => 'Please enter a valid email',
                    'last' => true),
            ),
            'address' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s Address')
            ),
            'city' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s City')
            ),
            'state' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s State')
            ),
            'zip' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s Zip')
            ),
            'country' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s Country')
            ),
            'phone' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the League\'s Contact Number')
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}

?>
