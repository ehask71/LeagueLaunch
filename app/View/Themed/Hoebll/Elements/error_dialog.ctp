<?php
echo json_encode(
        array('success'=>0,'content'=> $message.$this->Html->nestedList($errors, array(), array(), 'ol')
));