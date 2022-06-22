<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MyTestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //设置运行超时后尝试重新运行次数
    public $tries = 5;

    //设置任务失败时尝试重新运行次数
    public $maxExceptions = 5;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::channel('daily')->info('mytestjob',$this->data);
    }


    public function fail($exception = null)
    {
        //处理失败相关
    }

    /**
     * 设置最大超时时间
     * @return \Illuminate\Support\Carbon
     */
    public function retryUntil()
    {
        return now()->addSeconds(10);
    }


}
