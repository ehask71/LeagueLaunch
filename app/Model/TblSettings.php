<?php
App::uses('AppModel', 'Model');
/**
 * Description of TblSettings
 *
 * @author Eric
 */
class TblSettings extends AppModel{
    
    public $useTable = 'settings';
    
    public $belongsTo = array(
        'TblSites' => array(
            'className'    => 'TblSites',
            'foreignKey'   => 'site_id'
        )
    );
    
    function getSiteSettings($siteid){
	$sql = "SELECT name,value,type FROM settings WHERE site_id = '$siteid'";
	$result = $this->query($sql);
	$settings = array();
	if(count($result)>0){
	    foreach ($result as $row) {
		if($row['type'] == 'object' || $row['type'] == 'array'){
                    // Handle Arrays and Objects
                    $settings[$row['name']] = unserialize($row['value']);
                } else {
                    // Default is string
                    $settings[$row['name']] = (string)$row['value'];
                }
	    }
	}
	
	return $settings;
    }
    
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
	
	return $settings;
    }
}

?>
