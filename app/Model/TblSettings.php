<?php
App::uses('AppModel', 'Model');
/**
 * Description of TblSettings
 *
 * @author Eric
 */
class TblSettings extends AppModel{
    
    public $useTable = 'settings';
    
    function getSiteSettings($siteid){
	$sql = "SELECT name,value FROM settings WHERE siteid = '$siteid'";
	$result = $this->query($sql);
	$settings = array();
	if(count($result)>0){
	    foreach ($result as $key => $value) {
		$settings[$key] = $value;
	    }
	}
	
	return $settings;
    }
}

?>
