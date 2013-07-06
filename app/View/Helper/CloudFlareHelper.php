<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP CloudFlareHelper
 * @author Eric
 */
class CloudFlareHelper extends AppHelper {

    public $helpers = array('Html');
    private $assetHost = 'cdn.leaguelaunch.com';

    /**
     * Where are the images relative to web root (local should mirror remote)
     * Try to stick to cake conventions.
     */
    private $imgDir = 'img';

    /**
     * Where are the JS files relative to web root (local should mirror remote)
     * Try to stick to cake conventions.
     */
    private $jsDir = 'js';

    /**
     * Where are the CSS files relative to web root (local should mirror remote)
     * Try to stick to cake conventions.
     */
    private $cssDir = 'css';

    /**
     * Will set asset directory depending on the asset type (css, js, img)
     */
    private $assetDir = NULL;
    private $assetTypes = array(
	'css' => array('pathPrefix' => CSS_URL, 'ext' => '.css'),
	'js' => array('pathPrefix' => JS_URL, 'ext' => '.js'),
	'img' => array('pathPrefix' => IMAGES_URL)
    );

    /**
     * We should really force the timestamp to improve caching.
     * Trun on the option in core.php
     */
    private $forceTimestamp = FALSE;
    private $assets = NULL;

    /**
     * Return image path/URL either remote or local based on the debug level
     */
    public function image($assets, $options = array()) {
	//$this->setAssetDir($this->imgDir);
	$this->assets = $assets;
	return $this->Html->image($this->setAssetPath($assets), $options);
    }

    /**
     * Return JS link path/URL either remote or local based on the debug level
     */
    public function script($assets, $options = array()) {
	//$this->setAssetDir($this->jsDir);
	$this->assets = $assets;
	return $this->Html->script($this->setAssetPath($assets), $options);
    }

    public function css($assets, $options = array()) {
	$this->assets = $assets;
	//$this->setAssetDir($this->cssDir);
	//mail('ehask71@gmail.com','Asset URL',$this->setAssetPath($assets));

	return $this->Html->css($this->setAssetPath($assets, 'css'), $options);
    }

    private function setAssetPath($assets = NULL, $type = NULL) {
	if ($assets && Configure::read('debug') == 0) {
	    if (is_array($assets)) {
		for ($i = 0; $i < count($assets); $i++) {
		    $this->setAssetDir($this->$type . 'Dir');
		    $assets[$i] = $this->assetUrl($this->pathPrep() . $assets[$i] . $this->getAssetTimestamp(), $options + $this->assetTypes[$type]);
		}
	    } else {
		$this->setAssetDir($this->$type . 'Dir');
		return $this->assetUrl($this->pathPrep() . $assets . $this->getAssetTimestamp(), $options + $this->assetTypes[$type]);
	    }
	}
	return $assets;
    }

    /**
     * Build asset URL
     */
    private function pathPrep() {
	return $this->getProtocol() . $this->getAssetHost($this->assetHost);
    }

    /**
     * Set proper asset directory (relative to web root), based on the asset type
     */
    private function setAssetDir($dir = NULL) {
	if ($dir) {
	    $this->assetDir = '/' . $dir . '/';
	}
    }

    /**
     * Get asset timestamp
     * We assume that local filesystem has the same assets (and dir structure) as the remote one
     * (It really should to make managment and version controll painless)
     */
    private function getAssetTimestamp() {
	if ($this->forceTimestamp == TRUE) {
	    return '?' . @filemtime(str_replace('/', DS, WWW_ROOT . $this->assetDir));
	}
	return FALSE;
    }

    /**
     * HTTPS or not?
     */
    private function getProtocol() {
	if (env('HTTPS')) {
	    return 'https://';
	}
	return 'http://';
    }

    /**
     * Return host name.
     * Options: 
     * - multiple hosts (generate random host names based on $this->numHostsMin and $this->numHostsMax
     * - single host
     * - SSL host
     * 
     */
    private function getAssetHost() {
	if (!env('HTTPS')) {
	    if (strstr($this->assetHost, '%d')) {
		$randomHost = rand($this->numHostsMin, $this->numHostsMax);
		return sprintf($this->assetHost, $randomHost);
	    } else {
		return $this->assetHost;
	    }
	} elseif (env('HTTPS')) {
	    return $this->sslHost;
	}
    }

}
