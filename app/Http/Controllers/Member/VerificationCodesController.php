<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\VerficationCodeRequest;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class VerificationCodesController extends Controller
{
    public function store(VerficationCodeRequest $request, EasySms $easySms)
    {
        $phone = $request->phone;

        $code = '1234'; // 测试用
        // $code = random_int(1111, 9999);
        // $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

/*        try {
            $result = $easySms->send($phone, [
                'content' => "【赵庆昌】您的验证码是{$code}。如非本人操作，请忽略本短信",
            ]);
        } catch (NoGatewayAvailableException $exception) {
            $message = $exception->getException('yunpian')->getMessage();
            return response(['status' => 'error', 'message' => $message ?? '短信发送异常']);
        }*/

        // 短信验证码缓存十分钟
        /*        $key = 'verificationCode_' . str_random(15);
                $expiredAt = now()->addMinutes(10);
                \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);*/

        session(['verificationCode_' . $phone => $code]);

        return response(['status' => 'success', 'data' => []]);
    }
}
