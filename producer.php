<?php

require __DIR__ . '/vendor/autoload.php';

$broker = \MessageBroker\Factories\Impl\KafkaMessageBrokerFactory::getInstance();

foreach (range(1,1000) as $value){
    $broker->publish('event-tracking-topic', [
        'project' => 'DOGITAL_GOODS',
        'category' => 'APPLICATION',
        'name' => 'TRANSACTION_CREATE',
        'label' => 'LOG',
        'value' => $value,
        'properties' => [
            'browser' => 'mac-os',
            'authorized_push' => false,
            'authorized_gps' => false,
            'email_name' => 'adrianolaselva@gmail.com',
            'authorized_contacts' => false,
            'age' => 32,
            'blocked_user' => false,
        ],
    ], [], [
        'Content-Type' => 'application/json'
    ]);
}
