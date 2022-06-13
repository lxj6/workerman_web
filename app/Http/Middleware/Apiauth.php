<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\IFTTTHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Apiauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_caller = Auth::user();

        if ($api_caller == null) {
            $api_token = $request->headers->get('X-Api-Token');
            if ($api_token != null) {
                $this->validateApiAuthToken($api_token);
            } else {
                $api_enable_fake = env('API_CALLER_ENABLE_FAKE',false);
                if ($api_enable_fake == false) {
                    throw new UnauthorizedHttpException('x-api-token','api认证失败，找不到认证参数');
                }

                $caller_user_id = $request->headers->get('API-CALLER-ID');

                $caller_type = env('API_CALLER_TYPE',null);
                if (is_null($caller_user_id)) {
                    $caller_user_id = env('API_CALLER_ID',null);
                }

                if ($caller_type == null || $caller_user_id == null) {
                    throw new UnauthorizedHttpException('x-api-token','api认证失败，找不到认证参数');
                }

                $this->setCaller($caller_type, $caller_user_id);
            }
        }

        return $next($request);
    }

    public function validateApiAuthToken($token)
    {
        $arr = explode('.',$token);

        if (count($arr) != 2) {
            throw new UnauthorizedHttpException('x-api-token','token验证失败!');
        }

        $secret = env('API_SECRET');
        if (hash('sha256',$arr[0].$secret) != $arr[1]) {
            throw  new UnauthorizedHttpException('x-api-token','token验证失败!');
        }

        $arrJson = base64_decode($arr[0]);
        $data = json_decode($arrJson,JSON_UNESCAPED_UNICODE);

        if (time() > $data['exp']) {
            throw new UnauthorizedHttpException('x-api-token','token已失效，请重新登录');
        }

        $this->setCaller($data['type'], $data['user_id'], $data);

    }

    public function setCaller($type, $user_id, $arr = '')
    {
        $api_caller = '';

        switch (strtolower($type)) {
            case strtolower(User::Api_Caller_Type):
                $api_caller = User::find($user_id);
                break;
            default:
                throw new UnauthorizedHttpException('x-api-token','找不到认证参数');
                break;
        }

        Auth::login($api_caller);
    }

}
