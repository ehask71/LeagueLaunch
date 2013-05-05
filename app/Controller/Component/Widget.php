<?php
class WidgetComponent extends Object {

    function retrieve($modelName, $findType, $options = NULL) {
        $model = ClassRegistry::init($modelName);
        return $model->find($findType, $options);
    }

}
?>
