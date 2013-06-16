<?php

App::uses('AppModel', 'Model');

/**
 * Description of TblSettings
 *
 * @author Eric
 */
class Settings extends AppModel {

    public $findMethods = array('bysiteid' => true);
    public $useTable = 'settings';
    //public $actsAs = array('KeyValue');

    public $belongsTo = array(
	'Sites' => array(
	    'className' => 'Sites',
	    'foreignKey' => 'site_id'
	)
    );

    protected function _findBysiteid($state, $query, $results = array()) {
	if ($state === 'before') {
	    $query['conditions']['Settings.site_id'] = Configure::read('Settings.site_id');
	    return $query;
	}
	return $results;
    }

    public function buildSettings($site, $setarray) {
	$settings = array();
	if (count($setarray) > 0) {
	    foreach ($setarray as $row) {
		if ($row['type'] == 'object' || $row['type'] == 'array') {
		    // Handle Arrays and Objects
		    $settings[$row['name']] = unserialize($row['value']);
		} else {
		    // Default is string
		    $settings[$row['name']] = (string) $row['value'];
		}
	    }
	}

	if (!isset($settings['theme'])) {
	    $settings['theme'] = 'default';
	}

	if (!isset($settings['meta_keywords'])) {
	    App::import('model', 'Keywords');
	    $keywords = new Keywords();
	    $settings['meta_keywords'] = $keywords->getSportKeywords($site['sport']);
	}

	foreach ($settings as $key => $value) {
	    Configure::write("Settings." . $key, $value);
	}
	// Store Our Site_id for use elsewhere
	Configure::write("Settings.site_id", $site['site_id']);

	return $settings;
    }

    public function updateKeyVal($data) {
	if (is_array($data['Settings'])) {
	    foreach ($data['Settings'] AS $key => $var) {
		$this->query("INSERT INTO settings SET value = '" . addslashes($var) . "',name='" . $key . "',site_id = " . Configure::read('Settings.site_id') .
			" ON DUPLICATE KEY UPDATE
                                value='" . addslashes($var) . "'");
	    }
	}
    }
    
    public function buildPopulateArray(){
	$site_id = Configure::read('Settings.site_id');
	$settings = $this->find('bysiteid');
	print_r($settings);
	$data = array();
	foreach ($settings AS $row){
	    $data[$row['name']] = $row['value']; 
	}
	return $data;
    }

}

?>
