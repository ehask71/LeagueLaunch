<?php

/**
 * CakePHP BlocksComponent
 * @author EricMain
 */
class BlocksComponent extends Component {

    public $blocksForLayout = array();
    public $components = array();

    public function initialize($controller) {
	$this->controller = $controller;
	if (isset($controller->Block)) {
	    $this->Block = $controller->Block;
	} else {
	    $this->Block = ClassRegistry::init('Block');
	}
    }

    public function startup($controller) {
	if (!isset($controller->request->params['admin']) && !isset($controller->request->params['requested'])) {
	    $this->blocks();
	}
    }

    public function beforeRender($controller) {
	$controller->set('blocks_for_layout', $this->blocksForLayout);
    }

    public function shutDown($controller) {
	
    }

    public function beforeRedirect($controller, $url, $status = null, $exit = true) {
	
    }

    public function blocks() {
	
    }

    /**
     * Process blocks for bb-code like strings
     *
     * @param array $blocks
     * @return void
     */
    public function processBlocksData($blocks) {
	foreach ($blocks as $block) {
	    $this->blocksData['menus'] = Hash::merge(
			    $this->blocksData['menus'], $this->parseString('menu|m', $block['Block']['body'])
	    );
	    $this->blocksData['vocabularies'] = Hash::merge(
			    $this->blocksData['vocabularies'], $this->parseString('vocabulary|v', $block['Block']['body'])
	    );
	    $this->blocksData['nodes'] = Hash::merge(
			    $this->blocksData['nodes'], $this->parseString('node|n', $block['Block']['body'], array('convertOptionsToArray' => true)
	    ));
	}
    }

    /**
     * Parses bb-code like string.
     *
     * Example: string containing [menu:main option1="value"] will return an array like
     *
     * Array
     * (
     *     [main] => Array
     *         (
     *             [option1] => value
     *         )
     * )
     *
     * @param string $exp
     * @param string $text
     * @param array  $options
     * @return array
     */
    public function parseString($exp, $text, $options = array()) {
	$_options = array(
	    'convertOptionsToArray' => false,
	);
	$options = array_merge($_options, $options);

	$output = array();
	preg_match_all('/\[(' . $exp . '):([A-Za-z0-9_\-]*)(.*?)\]/i', $text, $tagMatches);
	for ($i = 0, $ii = count($tagMatches[1]); $i < $ii; $i++) {
	    $regex = '/(\S+)=[\'"]?((?:.(?![\'"]?\s+(?:\S+)=|[>\'"]))+.)[\'"]?/i';
	    preg_match_all($regex, $tagMatches[3][$i], $attributes);
	    $alias = $tagMatches[2][$i];
	    $aliasOptions = array();
	    for ($j = 0, $jj = count($attributes[0]); $j < $jj; $j++) {
		$aliasOptions[$attributes[1][$j]] = $attributes[2][$j];
	    }
	    if ($options['convertOptionsToArray']) {
		foreach ($aliasOptions as $optionKey => $optionValue) {
		    if (!is_array($optionValue) && strpos($optionValue, ':') !== false) {
			$aliasOptions[$optionKey] = $this->stringToArray($optionValue);
		    }
		}
	    }
	    $output[$alias] = $aliasOptions;
	}
	return $output;
    }

    /**
     * Converts formatted string to array
     *
     * A string formatted like 'Node.type:blog;' will be converted to
     * array('Node.type' => 'blog');
     *
     * @param string $string in this format: Node.type:blog;Node.user_id:1;
     * @return array
     */
    public function stringToArray($string) {
	$string = explode(';', $string);
	$stringArr = array();
	foreach ($string as $stringElement) {
	    if ($stringElement != null) {
		$stringElementE = explode(':', $stringElement);
		if (isset($stringElementE['1'])) {
		    $stringArr[$stringElementE['0']] = $stringElementE['1'];
		} else {
		    $stringArr[] = $stringElement;
		}
	    }
	}
	return $stringArr;
    }

}
