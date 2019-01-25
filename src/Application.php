<?php

namespace Mirafox\OnlineTest;

use RedBeanPHP\R as R;

/**
 * Class Application
 * @package Mirafox\OnlineTest
 */
class Application
{
    /**
     * @var - переменная для хранения экземпляра приложения
     */
    protected static $_instance;
    /**
     * @var array - массив для хранения настроек приложения
     */
    protected $container;

    /**
     * Функция запускает приложения (устанавливает все необходимые настройки)
     */
    public function start()
    {
        $config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';
        foreach ($config as $key => $value) {
            $this->set($key, $value);
        }
        class_alias('\RedBeanPHP\R', '\R');
        R::setup($this->get('DB')['dsn'], $this->get('DB')['login'], $this->get('DB')['password']);
    }

    /**
     * Функция возвращает единственный экземпляр приложения
     *
     * @return Application
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Функция возвращает значение конфигурации приложения
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->container[$key];
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        $this->container[$key] = $value;
    }

    /**
     * Закрываем метод. Паттерн singleton
     */
    protected function __clone()
    {

    }

    /**
     * Application constructor. Закрываем метод. Паттерн singleton
     */
    protected function __construct()
    {

    }

}