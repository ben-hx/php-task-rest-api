<?php


abstract class AppConfiguration
{
    const Production = 0;
    const Testing = 1;
    const Development = 2;
}

/**
 * Created by IntelliJ IDEA.
 * User: ben-hx
 * Date: 03.04.2016
 * Time: 15:26
 */
class Factory
{
    /**
     * instance
     *
     * Statische Variable, um die aktuelle (einzige!) Instanz dieser Klasse zu halten
     *
     * @var Factory
     */
    protected static $_instance = null;
    private $appConfiguration = AppConfiguration::Development;

    /**
     * get instance
     *
     * Falls die einzige Instanz noch nicht existiert, erstelle sie
     * Gebe die einzige Instanz dann zurück
     *
     * @return   Factory
     */
    public static function getInstance($config =  AppConfiguration::Development)
    {
        if (null === self::$_instance)
        {
            self::$_instance = new self;
        }
        self::$_instance->appConfiguration = $config;
        return self::$_instance;
    }

    /**
     * clone
     *
     * Kopieren der Instanz von aussen ebenfalls verbieten
     */
    protected function __clone() {}

    /**
     * constructor
     *
     * externe Instanzierung verbieten
     */
    protected function __construct() {}

    /**
     * createDBHandler
     *
     * Erzeugt eine Instanz der Klasse DBHandler
     *
     * @return   DBHandler
     */
    private function createDBConnection() {
        $configFile = null;
        switch ($this->appConfiguration)
        {
            case AppConfiguration::Production:
                $configFile = dirname(__FILE__) . '/config/Production-Config.php';
                break;
            case AppConfiguration::Testing:
                $configFile = dirname(__FILE__) . '/config/Testing-Config.php';
                break;
            default:
                $configFile = dirname(__FILE__) . '/config/Development-Config.php';
                break;
        }
        return new DbConnection($configFile);
    }

    /**
     * createUserRepository
     *
     * Erzeugt eine Instanz der Klasse UserRepository
     *
     * @return UserRepository
     */
    public function createUserRepository() {
        return new UserRepository($this->createDBConnection());
    }

    /**
     * createUserRepository
     *
     * Erzeugt eine Instanz der Klasse UserRepository
     *
     * @return UserRepository
     */
    public function createTaskRepository() {
        return new TaskRepository($this->createDBConnection());
    }
}