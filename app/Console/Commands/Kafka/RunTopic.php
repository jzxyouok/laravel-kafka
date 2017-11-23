<?php

namespace App\Console\Commands\Kafka;

use Illuminate\Console\Command;
use Kafka\ConsumerConfig;

class RunTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:run-topic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Kafka Topic';

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
        $config->setTopics([
            ['topic' => 'test',
             'value' => 'test kafka message.',
             'key'   => '', ],
        ]);
    }
}
