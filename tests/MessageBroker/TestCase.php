<?php

namespace Tests\MessageBroker;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @var \MessageBroker\Interfaces\IMessageBroker
     */
    protected $kafkaMessageBroker;

    protected function setUp(): void
    {
        $this->kafkaMessageBroker = \MessageBroker\MessageBrokerFactory::getInstance(\MessageBroker\Enum\MessageBrokerTypeEnum::KAFKA);
    }

}