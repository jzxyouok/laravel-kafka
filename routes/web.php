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

Route::get('/producer', function () {
    $config = ProducerConfig::getInstance();
    $config->setMetadataRefreshIntervalMs(10000);
    $config->setMetadataBrokerList('127.0.0.1:9292');
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
        dd($result);
    });
    $producer->error(function ($errorCode) {
        dd($errorCode);
    });
    $producer->send(true);

    //return view('welcome');
});

Route::get('/consumer', function () {
    $config = ConsumerConfig::getInstance();
    $config->setMetadataRefreshIntervalMs(10000);
    $config->setMetadataBrokerList('127.0.0.1:9092');
    $config->setGroupId('test');
    $config->setBrokerVersion('0.10.2.1');
    $config->setTopics(array('test'));
    $config->setOffsetReset('earliest');
    $consumer = new \Kafka\Consumer();
    $consumer->start(function ($topic, $part, $message) {
        var_dump($message);
    });
});
