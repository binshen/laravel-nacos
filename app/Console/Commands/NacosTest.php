<?php

namespace App\Console\Commands;

use alibaba\nacos\request\naming\GetInstanceNaming;
use alibaba\nacos\request\naming\ListInstanceNaming;
use Illuminate\Console\Command;

class NacosTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
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
        \alibaba\nacos\NacosConfig::setHost("http://127.0.0.1:8848/");

        $listInstanceDiscovery = new ListInstanceNaming();
        $listInstanceDiscovery->setServiceName("laravel-nacos-service");
        $listInstanceDiscovery->setNamespaceId("public");
        $listInstanceDiscovery->setClusters("");
        $listInstanceDiscovery->setHealthyOnly(false);

        $response = $listInstanceDiscovery->doRequest();
        $content = $response->getBody()->getContents();
        var_dump($content);

//        $getInstanceDiscovery = new \alibaba\nacos\request\naming\GetInstanceNaming();
//        $getInstanceDiscovery->setServiceName("laravel-nacos-service");
//        $getInstanceDiscovery->setIp("192.168.1.14");
//        $getInstanceDiscovery->setPort("8080");
//        $getInstanceDiscovery->setNamespaceId("public");
//        $getInstanceDiscovery->setCluster("");
//        $getInstanceDiscovery->setHealthyOnly(false);
//
//        $response = $getInstanceDiscovery->doRequest();
//        $content = $response->getBody()->getContents();
//        var_dump($content);
    }
}
