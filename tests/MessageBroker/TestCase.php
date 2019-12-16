<?php

namespace Tests\MessageBroker;

use MessageBroker\Factories\Impl\KafkaMessageBrokerFactory;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @var \MessageBroker\Interfaces\IMessageBroker
     */
    protected $kafkaMessageBroker;

    protected function setUp(): void
    {
        $this->kafkaMessageBroker = KafkaMessageBrokerFactory::getInstance();
    }

}