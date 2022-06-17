<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testcommand {user?} {--opt=:可选参数}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is my test command';

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
        $str = "test -{$this->argument('user')} --opt= {$this->option('opt')}";

        Log::info("test -{$this->argument('user')} --opt= {$this->option('opt')}");
    }
}
