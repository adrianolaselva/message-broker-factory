<?php


namespace MessageBroker\Factories\Impl;


use MessageBroker\Brokers\Impl\KafkaMessageBroker;
use MessageBroker\Interfaces\IMessageBroker;
use MessageBroker\Interfaces\IMessageBrokerFactory;

class KafkaMessageBrokerFactory implements IMessageBrokerFactory
{
    /**
     * @return IMessageBroker
     */
    public static function getInstance(): IMessageBroker
    {
        return new KafkaMessageBroker();
    }
}