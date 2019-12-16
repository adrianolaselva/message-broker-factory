<?php

namespace Tests\MessageBroker\Brokers;

use Tests\MessageBroker\TestCase;

class KafkaMessageBrokerTest extends TestCase
{
    public function testPublish()
    {
        $this->kafkaMessageBroker->publish('test-message', [
            'message' => 'test'
        ], [], [
            'Content-Type' => 'application/json'
        ]);
        /**
         * @var $messageTopic \Interop\Queue\Message
         */
        $messageTopic = null;
        $this->kafkaMessageBroker->consumer('test-message', function (\Interop\Queue\Message $message, \MessageBroker\Interfaces\IMessageBroker $context) use (&$messageTopic) {
            $messageTopic = $message;
            $context->acknowledge($message);
            return false;
        });

        $payload = json_decode($messageTopic->getBody(), true);
        $headers = $messageTopic->getHeaders();

        var_dump($messageTopic->getMessageId());

        $this->assertNotEmpty($payload);
        $this->assertEquals('test', $payload['message']);
        $this->assertEquals('application/json', $headers['Content-Type']);
    }
}