<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorizationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class AuthorizationsController extends Controller
{
    protected $hasher;

    public function __construct(HasherContract $hasher)
    {
        $this->hasher = $hasher;
    }

    public function store(AuthorizationRequest $request)
    {
        $username = $request->user_name;
        $credentials['phone'] = $username;
        $credentials['password'] = $request->password;

        if (!$employee = Employee::where('phone', $username)->first())
        {
            return $this->response()->errorUnauthorized('用户名不存在');
        }

        if(!$this->hasher->check($request->password, $employee->getAuthPassword())) {
            return $this->response()->errorUnauthorized('用户名或密码错误');
        }

        $token = $this->getToken();

        return $this->reponse->array([
            'api_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' =>  \Auth::guard('api')->factory()->getTTL() * 60,
        ])->setStatus(201);

        return response('this is v1 login');
    }

    protected function getToken()
    {
        return md5('this is a demo string.');
    }

    public function destroy()
    {
        return response('this is v1 logout');
    }

    public function refreshToken()
    {
        return response('this is vi refresh_token');
    }
}
