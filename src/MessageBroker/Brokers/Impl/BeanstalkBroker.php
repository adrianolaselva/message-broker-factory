<?php

namespace MessageBroker\Brokers\Impl;

use Closure;
use MessageBroker\Interfaces\IMessageBroker;

/**
 * Class BeanstalkBroker
 * @package MessageBroker\Impl
 */
class BeanstalkBroker implements IMessageBroker
{

    /**
     * @param string $topic
     * @param array $message
     * @param array $properties
     * @param array $headers
     * @return bool
     */
    public function publish(string $topic, array $message, array $properties = [], array $headers = []): void
    {
        // TODO: Implement publish() method.
    }

    /**
     * @param string $topic
     * @param Closure $clojure
     */
    public function consumer(string $topic, Closure $clojure): void
    {
        // TODO: Implement consumer() method.
    }

    /**
     * @param $message
     */
    public function acknowledge($message): void
    {
        // TODO: Implement acknowledge() method.
    }
}