# laravel-kafka

## Install Zookeeper

`brew install zookeeper`

### Manage Service

* Recommended

`brew services start zookeeper`

* Demo

`zkService start`

## Install Kafka

`brew install kafka`

### Manage Service

* Recommended

`brew services start kafka`

* Demo

`zookeeper-server-start /usr/local/etc/kafka/zookeeper.properties & kafka-server-start /usr/local/etc/kafka/server.properties`

## Install PHPRDKafka

`brew install homebrew/php/php71-rdkafka`

## Install Composer

`composer require nmred/kafka-php`




