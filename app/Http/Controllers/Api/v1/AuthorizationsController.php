<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthorizationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class AuthorizationsController extends Controller
{
    protected $hasher;

    public function __construct(HasherContract $hasher)
    {
        $this->hasher = $hasher;
    }

    // 登陆
    public function store(AuthorizationRequest $request)
    {

        $username = $request->user_name;
        $credentials['phone'] = $username;
        $credentials['password'] = $request->password;

        if (!$employee = Employee::where('phone', $username)->first())
        {
            return $this->response->errorUnauthorized('用户名不存在');
        }

        if(!$this->hasher->check($request->password, $employee->getAuthPassword())) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        $employee->api_token = $employee->getToken();
        $employee->save();

        return $this->response->array([
            'api_token' => $employee->api_token,
            'token_type' => 'Bearer',
            'expires_in' =>  24 * 60
        ])->setStatusCode(200);

    }

    // 推出登陆
    public function destroy()
    {
        $user = Auth::guard('api')->user();
        $user->api_token = '';
        $user->save();

        return $this->response->noContent();
    }

    public function refreshToken()
    {
        return response('this is vi refresh_token');
    }
}
