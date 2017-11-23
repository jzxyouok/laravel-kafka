<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Kafka\ConsumerConfig;
use Kafka\Producer;
use Kafka\ProducerConfig;

Route::get('/topic', function () {
    //添加Topic
    $config = ConsumerConfig::getInstance();
    $config->setTopics([
        ['topic' => 'test',
         'value' => 'test kafka message.',
         'key'   => 'crazy_lee', ],
    ]);
});

Route::get('/producer', function () {
    //生产者
    $config = ProducerConfig::getInstance();
    $config->setMetadataRefreshIntervalMs(10000);
    $config->setMetadataBrokerList('127.0.0.1:9092');
    $config->setBrokerVersion('0.10.0.1');
    $config->setRequiredAck(1);
    $config->setIsAsyn(false);
    $config->setProduceInterval(500);
    $producer = new Producer(function () {
        return array(
            array(
                'topic' => 'test',
                'value' => 'test kafka message.',
                'key'   => 'crazy_lee',
            ),
        );
    });
    $producer->success(function ($result) {
        return $result;
    });
    $producer->error(function ($errorCode) {
        return $errorCode;
    });

    $producer->send(true);

    //return view('welcome');
});

Route::get('/consumer', function () {
    //消费者
    $config = ConsumerConfig::getInstance();
    $config->setMetadataRefreshIntervalMs(10000);
    $config->setMetadataBrokerList('127.0.0.1:9092');
    $config->setGroupId('test');
    $config->setBrokerVersion('0.10.0.1');
    $config->setTopics(array('test'));
    $config->setOffsetReset('earliest');
    $consumer = new \Kafka\Consumer();
    $consumer->start(function ($topic, $part, $message) {
        return $message;
    });
});
