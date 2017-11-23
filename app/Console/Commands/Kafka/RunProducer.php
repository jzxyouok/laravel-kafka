<?php

namespace App\Console\Commands\Kafka;

use Illuminate\Console\Command;
use Kafka\Producer;
use Kafka\ProducerConfig;

class RunProducer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:producer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kafka Producer';

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
    }
}
