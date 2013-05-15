<?php
App::uses('AppModel', 'Model');
/**
 * Description of TblSettings
 *
 * @author Eric
 */
class Settings extends AppModel{
    
    public $useTable = 'settings';
    
    public $belongsTo = array(
        'Sites' => array(
            'className'    => 'Sites',
            'foreignKey'   => 'site_id'
        )
    );
    
    function buildSettings($site,$setarray){
	$settings = array();
	if(count($setarray)>0){
	    foreach ($setarray as $row) {
		if($row['type'] == 'object' || $row['type'] == 'array'){
                    // Handle Arrays and Objects
                    $settings[$row['name']] = unserialize($row['value']);
                } else {
                    // Default is string
                    $settings[$row['name']] = (string)$row['value'];
                }
	    }
	}
	
	if(!isset($settings['theme'])){
	    $settings['theme'] = 'default';
	}
	
        if(!isset($settings['meta_keywords'])){
            App::import('model','Keywords');
            $keywords = new Keywords();
            $settings['meta_keywords'] = $keywords->getSportKeywords($site['sport']);
        }
        
        foreach($settings as $key=>$value){
            Configure::write("Settings.".$key, $value);
        }
        
	return $settings;
    }
}

?>
