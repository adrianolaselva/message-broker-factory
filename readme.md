
# Camada de abstração para brokers de mensageria


## Apache Kafka

```sh
KAFKA_GROUP_ID=event-tracking-outbound-command
KAFKA_METADATA_BROKER_LIST=127.0.0.1:9092
KAFKA_ENABLE_AUTO_COMMIT=false
KAFKA_AUTO_OFFSET_RESET=earliest
```

#### Descrição das variáveis de ambiente

- KAFKA_GROUP_ID: Identificação do worker group
- KAFKA_METADATA_BROKER_LIST: Hosts do kafka
- KAFKA_ENABLE_AUTO_COMMIT: Habilita ou desabilita auto commit
- KAFKA_AUTO_OFFSET_RESET: Configuração de offset

#### Criar Instância do broker

```php
$broker = \MessageBroker\Factories\Impl\KafkaMessageBrokerFactory::getInstance();
```

Obs: foi implementado um factory para cada implementação de broker de mensageria

#### Publicar mensagem em determinado tópico

```php
$broker->publish('event-tracking-topic', [
        'project' => 'DOGITAL_GOODS',
        'category' => 'APPLICATION',
        'name' => 'TRANSACTION_CREATE',
        'label' => 'LOG',
        'value' => rand(1, 10000),
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
```

#### Consumir mensagens de determinado tópico

```php
$broker->consumer('event-tracking-topic', function (\Interop\Queue\Message $message, \MessageBroker\Interfaces\IMessageBroker $context) {
    var_dump($message->getBody());
    $context->acknowledge($message);
});
```

Obs: O consumer fica aguardando mensagens de determinado tópico e para consumir