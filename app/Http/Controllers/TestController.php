<?php
namespace App\Http\Controllers;



use App\Jobs\MyTestJob;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function test()
    {
        $arr = ['test' => 1,'test2' => 233];
        echo now()->addSeconds(1);
        $bool = MyTestJob::dispatch($arr)->onQueue('MyTestJob');
        var_dump($bool);
    }
}
