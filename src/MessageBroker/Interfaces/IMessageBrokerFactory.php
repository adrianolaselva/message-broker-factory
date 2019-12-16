<?php


namespace MessageBroker\Interfaces;

/**
 * Interface IMessageBrokerFactory
 * @package MessageBroker\Interfaces
 */
interface IMessageBrokerFactory
{
    public static function getInstance(): IMessageBroker;
}