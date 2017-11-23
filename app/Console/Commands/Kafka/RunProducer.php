<?php

namespace App\Console\Commands\Kafka;

use Illuminate\Console\Command;
use Kafka\Producer;
use Kafka\ProducerConfig;
use Monolog\Logger;

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
        $logger = new Logger('my_logger');

        $config = ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('127.0.0.1:9092');
        $config->setBrokerVersion('0.10.0.1');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new Producer();
        //$producer->setLogger($logger);
        //$producer->success(function ($result) {
        //    //操作成功，回调处理
        //    //var_dump($result);
        //
        //    return $result;
        //});
        //$producer->error(function ($errorCode) {
        //    var_dump($errorCode);
        //});

        $producer->send([
            [
                'topic' => 'test',
                'value' => 'what are you doing now?',
                'key'   => '',
            ],
        ]);
    }
}
