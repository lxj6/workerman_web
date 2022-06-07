<?php
namespace App\Http\Controllers;
use App\Models\User;
use GatewayWorker\Lib\Gateway;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {

        $list = User::first();


        //User::add('test','test');
        /*$arr = [
            'user_name' => 'lxj',
            'password' => password_hash('123456',PASSWORD_BCRYPT),
        ];
        $count = DB::table('user')->insertGetId($arr);*/
        //$count = DB::table('user')->where('id',3)->update(['user_name' => 'lxjs']);
        //var_dump($count);
    }
}
