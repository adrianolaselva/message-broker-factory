<?php

namespace MessageBroker\Interfaces;

use Closure;

/**
 * Interface IMessageBroker
 * @package MessageBroker
 */
interface IMessageBroker
{
    /**
     * @param string $topic
     * @param array $message
     * @param array $properties
     * @param array $headers
     * @return bool
     */
    public function publish(string $topic, array $message, array $properties = [], array $headers = []): void;

    /**
     * @param string $topic
     * @param Closure $clojure
     */
    public function consumer(string $topic,  Closure $clojure): void;

    /**
     * @param $message
     */
    public function acknowledge($message): void;

}