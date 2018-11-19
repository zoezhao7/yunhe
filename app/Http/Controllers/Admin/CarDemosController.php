<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\CarDemoRequest;
use App\Models\Car;
use App\Models\CarDemo;
use App\Transformers\CarDemoHubTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarDemosController extends Controller
{

    public function upload(Request $request, ImageUploadHandler $uploader)
    {
        if ($request->file) {
            $result = $uploader->save($request->file, 'car_demos', 1100);
            $image = $result['path'];
        }
        return response(['image' => $image]);
    }

    public function index()
    {
        $carDemos = CarDemo::query()->paginate();
        return view('admin.car_demos.index', compact('carDemos'));
    }

    public function create(CarDemo $carDemo)
    {
        $more['front']['top'] = 0;
        $more['front']['left'] = 0;
        $more['rear']['top'] = 0;
        $more['rear']['left'] = 0;
        return view('admin.car_demos.create_and_edit', compact('carDemo', 'more'));
    }

    public function store(CarDemoRequest $request)
    {
        $data = $request->only('name', 'image', 'more');
        $data['more'] = json_encode($data['more']);
        CarDemo::create($data);

        return redirect()->route('admin.car_demos.index')->with('success', '添加成功！');
    }

    public function edit(CarDemo $carDemo)
    {
        $more = json_decode($carDemo->more, true);

        $morePx['front']['top'] = 500 * (float)$more['front']['top'] / 100;
        $morePx['front']['left'] = 1100 * (float)$more['front']['left'] / 100;
        $morePx['rear']['top'] = 500 * (float)$more['rear']['top'] / 100;
        $morePx['rear']['left'] = 1100 * (float)$more['rear']['left'] / 100;

        return view('admin.car_demos.create_and_edit', compact('carDemo', 'more', 'morePx'));
    }

    public function update(CarDemo $carDemo, CarDemoRequest $request)
    {
        $data = $request->only(['name', 'image', 'more']);
        $data['more'] = json_encode($data['more']);

        $carDemo->update($data);

        return redirect()->back()->with('success', '更新成功！');
    }

    public function destroy(CarDemo $carDemo)
    {
        $carDemo->delete();

        return redirect()->back()->with('success', '删除成功！');
    }

}
