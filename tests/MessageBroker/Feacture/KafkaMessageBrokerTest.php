<?php

namespace Tests\Facture\MessageBroker;

use Tests\MessageBroker\TestCase;

class KafkaMessageBrokerTest extends TestCase
{
    public function testPublish()
    {
        $this->kafkaMessageBroker->publish('test-message', [
            'message' => 'test'
        ]);
        $messageTopic = null;
        $this->kafkaMessageBroker->consumer('test-message', function (\Interop\Queue\Message $message, \MessageBroker\Interfaces\IMessageBroker $context) use (&$messageTopic) {
            $messageTopic = $message;
            $context->acknowledge($message);
            return false;
        });
        $this->assertNotEmpty($messageTopic);
    }
}