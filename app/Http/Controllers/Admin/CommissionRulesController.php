<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommissionRuleRequest;
use App\Models\CommissionRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionRulesController extends Controller
{
    public function edit()
    {
        $commissionRule = CommissionRule::first();
        if(!$commissionRule) {
            $commissionRule = app(CommissionRule::class);
        }

        return view('admin.commission_rules.create_and_edit', compact('commissionRule'));
    }

    public function update(CommissionRuleRequest $request)
    {
        $mins = $request->mins;
        $maxs = $request->maxs;
        $rates = $request->rates;
        $subordinate_rate = $request->subordinate_rate;
        $errors = [];

        foreach ($mins as $key => $min) {
            if (!$rates[$key] || $rates[$key] >= 100) {
                $errors[] = '佣金比例填写错误，必须大于0小于100；';
            }
            if ($maxs[$key]>0 && $maxs[$key] < $min) {
                $errors[] = '销量填写错误， 示例：1 - 5 ；';
            }
            if ($key > 0 && $min - $maxs[$key - 1] !== 1) {
                $errors[] = '销量区间不能有间隔，示例：1 - 5，6 - 10， 11 - ；';
            }
            if ($key == count($mins) - 1) {
                $maxs[$key] = 0;
            }

            $data['sale_rate'][] = [
                'min' => $min,
                'max' => $maxs[$key],
                'rate' => $rates[$key] / 100,
            ];
        }

        if($subordinate_rate<=0 || $subordinate_rate>=100) {
            $errors[] = '渠道提成填写错误，必须大于0小于100';
        }

        if ($errors) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $data['sale_rate'] = json_encode($data['sale_rate']);
        $data['subordinate_rate'] = $subordinate_rate / 100;

        $commissionRule = CommissionRule::first();
        if($commissionRule) {
            $commissionRule->update($data);
        }
        CommissionRule::create($data);

        return redirect()->route('admin.commission_rules.edit')->with('success', '佣金规则更新成功！');

    }
}
