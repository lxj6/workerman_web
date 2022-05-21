<?php

namespace App\Console\Commands;

use App\GatewayWorkerServer\Events;
use GatewayWorker\BusinessWorker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;
use Illuminate\Console\Command;
use Workerman\Worker;

class GatewayWorkerServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workerman {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start a workerman server';

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
     * @return int
     */
    public function handle()
    {
        global $argv;

        $action = $this->argument('action');

        $argv[0] = 'artisan workman';
        $argv[1] = $action;

        $this->start();
    }


    private function start()
    {
        $this->startRegister();
        $this->startBusiness();
        $this->startGateway();
        Worker::runAll();
    }

    /**
     * startBusiness
     *
     * @return void
     */
    private function startBusiness()
    {
        $business                  = new BusinessWorker();
        $business->name            = 'business';                  //进程名称
        $business->count           = 2;                           //进程数量
        $business->registerAddress = '127.0.0.0:2346';            //注册地址
        $business->eventHandler    = Events::class;               //处理业务类
    }

    /**
     * startGateway
     *
     * @return void
     */
    private function startGateway()
    {
        $gateway                       = new Gateway("websocket://0.0.0.0:2345");
        $gateway->name                 = 'gateway';        //进程名称
        $gateway->count                = 2;                //进程数量
        $gateway->lanIp                = '127.0.0.1';      //内网地址 集群设置register进程机器ip
        $gateway->startPort            = 2000;             //启动端口
        $gateway->registerAddress      = '127.0.0.1:2346'; //注册地址
        $gateway->pingInterval         = 30;               //心跳间隔时间
        $gateway->pingNotResponseLimit = 1;                //心跳发送方 0-server发送 1-client发送
        $gateway->pingData             = '';
    }

    /**
     * startRegister
     *
     * @return void
     */
    private function startRegister()
    {
        new Register("text://0.0.0.0:2346");
    }

}
