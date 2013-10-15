<?

class EmailConfig {

    public $default = array(
        'host' => 'mail.leaguelaunch.com',
        'port' => 25, 
        'username' => 'do-not-reply@leaguelaunch.com',
        'password' => '87.~~?ZG}eI}',
        'transport' => 'Smtp',
        'from' => 'do-not-reply@leaguelaunch.com',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
    );
    public $smtp = array(
        'transport' => 'Smtp',
        'from' => array('site@localhost' => 'My Site'),
        'host' => 'localhost',
        'port' => 25,
        'timeout' => 30,
        'username' => 'user',
        'password' => 'secret',
        'client' => null,
        'log' => false,
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
    );

}
?>
