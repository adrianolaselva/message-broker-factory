<?php

namespace MessageBroker;

abstract class MessageBrokerAbstract
{
    public function __construct()
    {
        $this->loadEnvironments();
    }

    protected function loadEnvironments()
    {
        $configFile = __DIR__ . '/../../config.ini';

        if(is_file($configFile))
        {
            foreach (parse_ini_file($configFile) as $key => $val)
            {
                putenv("{$key}={$val}");
            }
        }
    }
}