<?php
<<<<<<< HEAD

=======
>>>>>>> d9a22196cb533f70b8212da44f9b81b4d508eab4
class DATABASE_CONFIG {

    public $default = null;
    
    public $dev = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '',
        'login' => 'root',
        'password' => '',
        'database' => 'league',
        'schema' => '',
        'prefix' => '',
        'encoding' => ''
    );
    
    public $prod = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '',
        'login' => 'demoleag_site',
        'password' => '070693cory',
        'database' => 'demoleag_league',
        'schema' => '',
        'prefix' => '',
        'encoding' => ''
    );

    function __construct() {
        if (isset($_SERVER['CAKEDEV'])) {
            switch ($_SERVER['CAKEDEV']) {
                case 'ericmain':
                    $this->default = $this->dev;
                    break;
                default:
                    $this->default = $this->prod;
                    break;
            }
        } else { 
            $this->default = $this->prod;
        }
    }

}
