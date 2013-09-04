<h2>Register</h2> 
<?php
echo $this->Form->create();
echo $this->Form->input('site_id',array('type'=>'hidden','value'=>$site_id));
echo $this->Form->input('firstname');
echo $this->Form->input('lastname');
echo $this->Form->input('zip');
echo $this->Form->input('country');
echo $this->Form->input('birthdate');
echo $this->Form->input('gender',array('type'=>'radio','options'=>array('m','f')));
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->input('confirm_password');
echo $this->Form->input('agever',array('type'=>'checkbox','value'=>'yes','label' =>'Are you over the age of 13'));
echo $this->Form->input('agreeterms',array('type'=>'checkbox','value'=>'yes','label' => 'I agree to the <a href="/terms" target="_blank">Terms & Conditions</a>'));
echo $this->Form->end('Register');
?>