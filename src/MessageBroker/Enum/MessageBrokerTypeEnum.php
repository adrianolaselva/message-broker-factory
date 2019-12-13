<?php

namespace MessageBroker\Enum;

class MessageBrokerTypeEnum
{
    const KAFKA = \MessageBroker\Impl\KafkaMessageBroker::class;
    const RABBITMQ = \MessageBroker\Impl\RabbitMQMessageBroker::class;
    const BEANSTALK = \MessageBroker\Impl\BeanstalkBroker::class;
}