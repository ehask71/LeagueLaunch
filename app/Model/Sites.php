<?php
App::uses('AppModel', 'Model');
/**
 * Description of TblSites
 *
 * @author Eric
 */
class TblSites extends AppModel{
    
    public $useTable = 'sites';
    public $primaryKey = 'site_id';
    public $hasMany = 'TblSettings';
    
    public function getSiteId($domain){
	$sql = "SELECT * FROM sites WHERE domain = '$domain' AND isactive = 'yes'";
	$res = $this->query($sql);
	
	if(count($res)>0){
	    return $res;
	} else {
	    return FALSE;
	}
    }
}

?>
