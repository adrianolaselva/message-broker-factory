<?php

namespace MessageBroker;

use MessageBroker\Enum\MessageBrokerTypeEnum;
use MessageBroker\Impl\BeanstalkBroker;
use MessageBroker\Impl\KafkaMessageBroker;
use MessageBroker\Impl\RabbitMQMessageBroker;
use MessageBroker\Interfaces\IMessageBroker;

/**
 * Class MessageBrokerFactory
 * @package MessageBroker
 */
class MessageBrokerFactory
{
    /**
     * @param $messageBroker
     * @return IMessageBroker
     * @throws \Exception
     */
    public static function getInstance($messageBroker): IMessageBroker
    {
        switch ($messageBroker) {
            case MessageBrokerTypeEnum::KAFKA: return new KafkaMessageBroker();
            case MessageBrokerTypeEnum::RABBITMQ: return new RabbitMQMessageBroker();
            case MessageBrokerTypeEnum::BEANSTALK: return new BeanstalkBroker();
            default: throw new \Exception(sprintf("message broker %s not configured", $messageBroker));
        }
    }
}