<?php

App::uses('Controller', 'Controller');
App::uses('PhpReader', 'Configure');

class AppController extends Controller {

    public $viewClass = 'Theme';
    public $theme = 'default';
    public $uses = array('Settings', 'Sites', 'Widget');
    public $helpers = array('CloudFlare');
    public $components = array(
        'Session',
        'Auth' => array(
            'authorize' => array('Tiny'),
            'authenticate' => array(
                'all' => array('userModel' => 'Account'),
                'Form' => array(
                    'fields' => array('username' => 'email', 'password' => 'password'),
                    'scope' => array(
                        //'RolesUser.site_id' => $result['Sites']['site_id'],
                        'Account.is_active' => 'yes'
                    ),
                    'recursive' => 1,
                //'contain' => array('RolesUser')
            )),
            'flash' => array('key' => 'auth', 'element' => 'alerts/error'),
            'loginRedirect' => array('controller' => 'home', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'account', 'action' => 'login'),
            'loginAction' => '/login',
        )
    );

    public function canUploadMedias($model, $id) {
        return true;
    }

    public function beforeFilter() {
	if($this->params['controller'] == 'home' && $this->params['action'] == 'index'){
	    $this->set('isHomePage','true');
	}
	
        $domain = $this->Sites->getDomain();
        $sid = $this->Sites->getSiteId($domain);
        if ($sid) {
            $result = $this->Sites->find('first', array(
                'conditions' => array(
                    'Sites.site_id' => $sid['domains']['site_id'],
                    'Sites.isactive' => 'yes')
                    ));
            if (count($result) > 0) {
                $settings = $this->Settings->buildSettings($result['Sites'], $result['Settings']);

                // Set Theme From settings
                $this->theme = $settings['theme'];
                // Override if we are admin!
                if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
                    $this->theme = 'admin';
                }
                // Load Theme configs
                Configure::config('themeconfig', new PhpReader(APP . 'View' . DS . 'Themed' . DS . ucfirst($this->theme) . DS));
                Configure::load($this->theme . 'conf', 'themeconfig', true);

                // Load Widgets For Theme page
                $this->Widget->build($this->prefix, $this->params['controller'], $this->params['action']);
                // Make User Info avail to the View & Set a $loggedIn bool
                $this->set('userinfo', $this->Auth->user());
                $this->set('loggedIn', $this->Auth->loggedIn());
                // Set Needed Data (meta, domain, etc)
                $this->set('meta_keywords', (@$settings['meta_keywords'] != '') ? @$settings['meta_keywords'] : 'League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
                $this->set('meta_description', (@$settings['meta_description'] != '') ? @$settings['meta_description'] : 'LeagueLaunch.com :: League Management Made Easy');
                $this->set('meta_abstract', '');
                $this->set('domain', $domain);
                $this->set('settings', $settings);
                $this->set('site_id', $result['Sites']['site_id']);
                $this->set('sitename',$result['Sites']['leaguename']);
            } else {
                $this->set('meta_keywords', 'League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
                $this->set('meta_description', 'LeagueLaunch.com :: League Management Made Easy');
                $this->set('meta_abstract', '');
                throw new NotFoundException($domain . ' Was not found or is misconfigured');
            }
        } else {
            $this->set('meta_keywords', 'League Launch,Sports Team management,League,Soccer,Baseball,Football,Hockey');
            $this->set('meta_description', 'LeagueLaunch.com :: League Management Made Easy');
            $this->set('meta_abstract', '');
            throw new NotFoundException($domain . ' Was not found or is misconfigured');
        }
    }

    public function beforeRender() {
        parent::beforeRender();
        //$this->_setCommonWidgets($this->params);
    }

    public function _setCommonWidgets($params) {
        $this->set('latestNews', $this->Widget->retrieve('News', 'latest'));
    }

    public function __unserializeFormStructure($formStructure) {
        $formStructure = unserialize($formStructure);
        $form = new Formbuilder($formStructure);
        $form_structure = $form->getArrayFormStructure();

        $FormStructure = null;
        $FormLabel = null;
        if (!empty($form_structure['form_structure'])) {
            $y = 0;
            foreach ($form_structure['form_structure'] as $idx => $fs):
                if (in_array($fs['cssClass'], array('tabbable', 'section_break'))):
                    continue;
                endif;

                if (in_array($fs['cssClass'], array('radio', 'checkbox', 'select'))):
                    //$FormStructure[] = Set::extract('/value', $fs['values']);//array($fs['cssClass'] => Set::extract('/value', $fs['values']));
                    foreach ($fs['values'] as $key => $value) {
                        $FormStructure[$y][$key] = $value['value'];
                    }

                    $FormLabel[$idx] = $content = html_entity_decode($fs['title'], ENT_COMPAT, "UTF-8");
                else:
                    $FormStructure[] = $fs['cssClass'];
                    $FormLabel[] = html_entity_decode($fs['values'], ENT_COMPAT, "UTF-8");
                endif;

                $y++;
            endforeach;
        }

        return array($FormStructure, $FormLabel);
    }

    function afterPaypalNotification($txnId) {

        $IPN = ClassRegistry::init('PaypalIpn.InstantPaymentNotification');
        $transaction = $IPN->findById($txnId);
        $this->log($transaction['InstantPaymentNotification']['id'], 'paypal');

        if ($transaction['InstantPaymentNotification']['payment_status'] == 'Completed') {
            //Yay!  We have monies!
            $this->loadModel('Order');
            // Status 2 = Paid :-)
            $status = 2;
            $this->Order->updateOrderStatus($transaction['InstantPaymentNotification']['invoice'], $status);
            mail('ehask71@gmail.com', 'PayPal IPN', print_r($transaction, 1));
            $IPN->email(array(
                'id' => $txnId,
                'message' => 'Thank you for your payment'
            ));
        } else {
            //Oh no, better look at this transaction to determine what to do; like email a decline letter.
            $IPN->email(array(
                'id' => $txnId,
                'message' => 'Your transaction was declined.'
            ));
        }
    }

    public function handleError($code, $description, $file = null, $line = null, $context = null) {
        if (error_reporting() == 0 || $code === 2048 || $code === 8192) {
            return;
        }
        // throw error for further handling
        throw new exception(strip_tags($description));
    }

}
