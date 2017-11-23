<?php

namespace App\Console\Commands\Kafka;

use Illuminate\Console\Command;
use Kafka\Consumer;
use Kafka\ConsumerConfig;

class RunConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kafka Consumer';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $config = ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('127.0.0.1:9092');
        $config->setGroupId('test');
        $config->setBrokerVersion('0.10.0.1');
        $config->setTopics(array('test'));
        $config->setOffsetReset('earliest');
        $consumer = new Consumer();
        $consumer->start(function ($topic, $part, $message) {
            return $message;
        });
    }
}
