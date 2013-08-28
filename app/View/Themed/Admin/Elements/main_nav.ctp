<ul id="menu">
    <li><a href="/admin/home">Dashboard<span class="icon1"></span></a>
	<ul>
	    <li><?php echo $this->html->link(__('Account'), array('prefix' => 'admin', 'controller' => 'sites', 'action' => 'account')); ?></li>
	    <li><?php echo $this->html->link(__('Settings'), array('prefix' => 'admin', 'controller' => 'sites', 'action' => 'settings')); ?></li>
	</ul>
    </li>
    <li><a href="#">League<span class="icon6"></span></a>
	<ul>	 
	    <li><?php echo $this->html->link(__('Seasons'), array('prefix' => 'admin', 'controller' => 'season','action'=>'index')); ?></li>
	    <li><?php echo $this->html->link(__('Divisions'), array('prefix' => 'admin', 'controller' => 'divisions','action'=>'index')); ?></li>
	    <li><?php echo $this->html->link(__('Teams'), array('prefix' => 'admin', 'controller' => 'team','action'=>'index')); ?></li>
	</ul>
    </li>
    <li><a href="#">Plugins<span class="icon6"></span></a>
	<ul>	 
	    <li><?php echo $this->html->link(__('Fundraisers'), array('prefix' => 'admin', 'controller' => 'fundraising')); ?></li>
	    <li><?php echo $this->html->link(__('Scheduler'), array('prefix' => 'admin', 'controller' => 'home')); ?></li>
	    <li><?php echo $this->html->link(__('Random Teams'), array('prefix' => 'admin', 'controller' => 'home')); ?></li>
	</ul>
    </li>
    <li><?php echo $this->html->link(__('Accounts') . '<span class="icon2"></span>', array('prefix' => 'admin', 'controller' => 'account'), array('escape' => FALSE)); ?></li>
    <li><?php echo $this->html->link(__('News') . '<span class="icon7"></span>', array('prefix' => 'admin', 'controller' => 'news'), array('escape' => FALSE)); ?>
	<ul>
	    <li><?php echo $this->html->link(__('Add New'), array('prefix' => 'admin', 'controller' => 'news','action' => 'new'), array('escape' => FALSE)); ?></li>
	</ul>
    </li>
    <li><?php echo $this->html->link(__('Registration') . '<span class="icon8"></span>', array('prefix' => 'admin', 'controller' => 'registration'), array('escape' => FALSE)); ?>
	<ul>
	    <li><?php echo $this->html->link(__('Add New'), array('prefix' => 'admin', 'controller' => 'registration','action' => 'new'), array('escape' => FALSE)); ?></li>
	</ul>
    </li>
    <li><?php echo $this->html->link(__('Forms') . '<span class="icon2"></span>', array('prefix' => 'admin', 'controller' => 'forms'), array('escape' => FALSE)); ?>
	<ul>
	    <li><?php echo $this->html->link(__('Add New'), array('prefix' => 'admin', 'controller' => 'forms','action' => 'new'), array('escape' => FALSE)); ?></li>
	</ul>
    </li>
    <!--<li><a href="grid.html">Grid<span class="icon8"></span></a></li>
    <li><a href="typography.html">Typography<span class="icon10"></span></a></li>-->
</ul><!--End of #menu-->