<?php

namespace App\Console\Commands;

use alibaba\nacos\request\naming\RegisterInstanceNaming;
use Illuminate\Console\Command;

class NacosRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:register';

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
        // 服务注册
        \alibaba\nacos\NacosConfig::setHost("http://127.0.0.1:8848/"); // 配置中心地址

        $naming = \alibaba\nacos\Naming::init(
            "laravel-nacos-service",
            "192.168.1.14",
            "8080",
            "public",
            "",
            false
        );
//        $naming->register();

//        $instanceList = $naming->listInstances();
//        var_dump($instanceList);

//        $instance = $naming->get();
//        var_dump($instance);

        $registerInstanceDiscovery = new RegisterInstanceNaming();
        $registerInstanceDiscovery->setIp("192.168.1.14");
        $registerInstanceDiscovery->setPort("8080");
        $registerInstanceDiscovery->setNamespaceId("public");
        $registerInstanceDiscovery->setWeight(1.0);
        $registerInstanceDiscovery->setEnable(true);
        $registerInstanceDiscovery->setHealthy(true);
        $registerInstanceDiscovery->setMetadata('{"sn": 12345}');
        $registerInstanceDiscovery->setClusterName("");
        $registerInstanceDiscovery->setServiceName("laravel-nacos-service");

        while (true) {
            $response = $registerInstanceDiscovery->doRequest();
            var_dump($response);
            sleep(5);
        }
    }
}
