<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\HubBatchRequest;
use App\Models\StockOrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hub;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;

class HubsController extends Controller
{

    public function index(Request $request)
    {

        $query = Hub::query()->orderBy('id', 'desc');

        if($request->has('sn') && $request->sn) {
            $query->where('sn', (string) $request->sn);
        }
        if($request->has('store_id') && $request->store_id) {
            $query->where('store_id', (int) $request->store_id);
        }
        if($request->has('status') && $request->status) {
            $query->where('status', (int) $request->status);
        }

        $hubs = $query->paginate();

        $stores = Store::select('id', 'name')->where('is_open', 1)->get();

        return view('admin.hubs.index', compact('hubs', 'stores', 'request'));
    }


    public function stockOrderStore(HubBatchRequest $request, Hub $hub)
    {
        $validator = Validator::make($request->all(), [
            'sns.*' => 'required|alpha_num|between:15,20',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $existing_sns = Hub::whereIn('sn', $request->sns)->pluck('sn')->toArray();
        if(!empty($existing_sns)) {
            $sns_str = implode(',', $existing_sns);
            return redirect()->back()->with('danger', 'sn码为[' . $sns_str . ']的轮毂已经存在，请核实！');
        }

        // 删除旧的订单产品绑定的轮毂sn
        Hub::where('stock_order_product_id', $request->stock_order_product_id)->delete();


        $stockOrderProduct = StockOrderProduct::where('id', $request->stock_order_product_id)->first();
        $hub->stock_order_product_id = $request->stock_order_product_id;
        $hub->stock_order_id = $stockOrderProduct->stock_order_id;
        $hub->color = $stockOrderProduct->color;
        foreach($request->sns as $hub_sn) {
            if(!$hub_sn) {
                continue;
            }
            $hubs[] = [
                'sn' => $hub_sn,
                'spec_id' => $stockOrderProduct->spec_id,
                'stock_order_product_id' => $request->stock_order_product_id,
                'stock_order_id' => $stockOrderProduct->stock_order_id,
                'color' => $stockOrderProduct->color,
                'created_at' => now(),
            ];
        }


        if(!empty($hubs) && Hub::insert($hubs)){
          return redirect()->back()->with('success', 'sn码添加成功！');
        }
        return redirect()->back()->with('danger', 'sn码添加失败，请重新尝试！');

    }

    public function store()
    {
        dd('this is hubs store');
    }
}
