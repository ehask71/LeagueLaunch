<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP RegionsHelper
 * @author Eric
 */
class RegionsHelper extends AppHelper {

    public $helpers = array();

    public function __construct(View $View, $settings = array()) {
	parent::__construct($View, $settings);
    }

    public function isEmpty($regionAlias) {
	if (isset($this->_View->viewVars['blocks_for_layout'][$regionAlias]) &&
		count($this->_View->viewVars['blocks_for_layout'][$regionAlias]) > 0) {
	    return false;
	} else {
	    return true;
	}
    }

    public function blocks($regionAlias, $options = array()) {
	$output = '';
	if ($this->isEmpty($regionAlias)) {
	    return $output;
	}

	$options = Hash::merge(array(
		    'elementOptions' => array(),
			), $options);
	$elementOptions = $options['elementOptions'];

	$defaultElement = 'Blocks.block';
	$blocks = $this->_View->viewVars['blocks_for_layout'][$regionAlias];
	foreach ($blocks as $block) {
	    $element = $block['Block']['element'];
	    $exists = $this->_View->elementExists($element);
	    $blockOutput = '';
	    if ($exists) {
		$blockOutput = $this->_View->element($element, compact('block'), $elementOptions);
	    } else {
		if (!empty($element)) {
		    $this->log(sprintf('Missing element `%s` in block `%s` (%s)', $block['Block']['element'], $block['Block']['alias'], $block['Block']['id']
			    ), LOG_WARNING);
		}
		$blockOutput = $this->_View->element($defaultElement, compact('block'), array('ignoreMissing' => true) + $elementOptions);
	    }
	    $enclosure = isset($block['Params']['enclosure']) ? $block['Params']['enclosure'] === "true" : true;
	    if ($exists && $element != $defaultElement && $enclosure) {
		$block['Block']['body'] = $blockOutput;
		$block['Block']['element'] = null;
		$output .= $this->_View->element($defaultElement, compact('block'), $elementOptions);
	    } else {
		$output .= $blockOutput;
	    }
	}

	return $output;
    }

    public function beforeRender($viewFile) {
	
    }

    public function afterRender($viewFile) {
	
    }

    public function beforeLayout($viewLayout) {
	
    }

    public function afterLayout($viewLayout) {
	
    }

}
