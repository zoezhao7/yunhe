<?php

use Illuminate\Database\Seeder;
use App\Models\Node;
use Carbon\Carbon;

class NodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $updated_at = Carbon::now();

        $created_at = $updated_at;

        // 模块
        $models = [
            ['产品', 'products'],
            ['门店', 'stores'],
            ['店长', 'staffs'],
        ];

        // 节点
        $nodes_array = [];
        foreach($models as $model)
        {
            $nodes_array[] = [$model[0], $model[1], '创建' . $model[0], 'create,store'];
            $nodes_array[] = [$model[0], $model[1], '编辑' . $model[0], 'edit,update'];
            $nodes_array[] = [$model[0], $model[1], '删除' . $model[0], 'delete'];
            $nodes_array[] = [$model[0], $model[1], '查询' . $model[0], 'index,show'];
        }

        // 存储数据
        $nodes = [];
        foreach($nodes_array as $key=>$node)
        {
            $nodes[] = [
                'controller_name' => $node[0],
                'controller' => $node[1],
                'action_name' => $node[2],
                'action' => $node[3],
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ];
        }

        Node::insert($nodes);
    }
}
