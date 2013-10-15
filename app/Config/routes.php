<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/', array('controller' => 'home', 'action' => 'index'));
	Router::connect('/privacy', array('controller' => 'home', 'action' => 'privacy'));
        Router::connect('/xinterface.html', array('controller' => 'home', 'action' => 'dialog'));
        Router::connect('/robots.txt', array('controller' => 'seo', 'action' => 'robots'));
	Router::connect('/login', array('controller' => 'account', 'action' => 'login'));
        Router::connect('/logout', array('controller' => 'account', 'action' => 'logout'));
	Router::connect('/register', array('controller' => 'account', 'action' => 'register'));
        Router::connect('/terms', array('controller' => 'home', 'action' => 'terms'));
        Router::connect('/about', array('controller' => 'home', 'action' => 'about'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

        /* Paypal IPN plugin */
        Router::connect('/paypal_ipn/process', array('plugin' => 'paypal_ipn', 'controller' => 'instant_payment_notifications', 'action' => 'process'));
        /* Optional Route, but nice for administration */
        //Router::connect('/admin/paypal_ipn/:action/*', array('admin' => 'true', 'plugin' => 'paypal_ipn', 'controller' => 'instant_payment_notifications', 'action' => 'index'));
        /* End Paypal IPN plugin */
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
