<?php
namespace App\Http\Controllers;



use App\Exceptions\BusinessException;
use App\Jobs\MyTestJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $user = User::where('id',$request->get('user_id'))->first();

        if (!$user) {
            BusinessException::throw('用户不存在');
        }

        Auth::login($user);

        return response()->success();
    }
}
