<?php

App::uses('Model', 'Model');

class AppModel extends Model {

    // For custom find('xxx') methods. The function looks for a __findFindType class method.
    function find($type, $options = array()) {
	$method = null;
	if (is_string($type)) {
	    $method = sprintf('__find%s', Inflector::camelize($type));
	}

	if ($method && method_exists($this, $method)) {
	    return $this->{$method}($options);
	} else {
	    $args = func_get_args();
	    return call_user_func_array(array('parent', 'find'), $args);
	}
    }

}
