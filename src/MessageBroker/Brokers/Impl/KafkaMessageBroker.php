<?php

namespace MessageBroker\Brokers\Impl;

use Closure;
use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Interop\Queue\Consumer;
use Interop\Queue\Context;
use Interop\Queue\Queue;
use MessageBroker\Interfaces\IMessageBroker;
use MessageBroker\MessageBrokerAbstract;
use MessageBroker\Serializers\DefaultEventSerializer;

/**
 * Class KafkaMessageBroker
 * @package MessageBroker\Impl
 */
class KafkaMessageBroker extends MessageBrokerAbstract implements IMessageBroker
{
    /**
     * @var RdKafkaConnectionFactory
     */
    private $connection;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var Queue
     */
    private $queue;

    /**
     * @var Consumer
     */
    private $consumer;

    /**
     * KafkaMessageBroker constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setup();
    }

    /**
     * @param string $topic
     * @param array $message
     * @param array $properties
     * @param array $headers
     * @return bool
     * @throws \Interop\Queue\Exception
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     */
    public function publish(string $topic, array $message, array $properties = [], array $headers = []): void
    {
        $message = $this->context->createMessage(json_encode($message), $properties, $headers);
        $message->setMessageId(sha1(time()));

        $this->context->createProducer()
            ->send(
                $this->context->createQueue($topic),
                $message
            );
    }

    /**
     * @param string $topic
     * @param Closure $clojure
     * @throws \Exception
     */
    public function consumer(string $topic, Closure $clojure): void
    {
        $consumer = $this->getConsumer($topic);

        do {
            try {
                $message = $consumer->receive();

                if(empty($message))
                    continue;

                $return = $clojure($message, $this);

                if(is_null($return))
                    continue;

                if(!$return)
                    break;

            } catch (\LogicException $ex) {

            } catch (\Exception $ex){
                throw $ex;
            }
        } while(true);
    }

    /**
     * @param $message
     */
    public function acknowledge($message): void
    {
        $this->consumer->acknowledge($message);
    }

    /**
     * @param string $topicName
     * @return Consumer
     */
    private function getConsumer(string $topicName): Consumer
    {
        $this->queue = $this->context->createQueue($topicName);
        $this->consumer = $this->context->createConsumer($this->queue);
        $this->consumer->setSerializer(new DefaultEventSerializer());

        return $this->consumer;
    }

    private function setup()
    {
        $this->connection = new RdKafkaConnectionFactory([
            'global' => [
                'group.id' => getenv('KAFKA_GROUP_ID') ?? '',
                'metadata.broker.list' => getenv('KAFKA_METADATA_BROKER_LIST') ?? '',
                'enable.auto.commit' => getenv('KAFKA_ENABLE_AUTO_COMMIT') ? 'true': 'false',
            ],
            'topic' => [
                'auto.offset.reset' => getenv('KAFKA_AUTO_OFFSET_RESET') ?? 'earliest',
            ],
        ]);

        $this->context = $this->connection->createContext();
    }

}