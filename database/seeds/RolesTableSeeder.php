<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Node;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = Carbon::now();

        // 角色的权限
        $product_nodes = Node::where('controller', 'products')->get();
        $store_nodes = Node::whereIn('controller', ['stores', 'staffs'])->get();

        foreach ($product_nodes as $node) {
            $product_node_ids[] = $node->id;
            $product_node_names[] = $node->action_name;
        }

        foreach ($store_nodes as $node) {
            $store_node_ids[] = $node->id;
            $store_node_names[] = $node->action_name;
        }

        // 角色
        $roles = [
            [
                'name' => '超级管理员',
                'node_ids' => json_encode([0]),
                'node_names' => '全部权限',
                'created_at' => $created_at,
            ],
            [
                'name' => '门店管理员',
                'node_ids' => json_encode($product_node_ids),
                'node_names' => implode(',', $product_node_names),
                'created_at' => $created_at,
            ],
            [
                'name' => '产品管理员',
                'node_ids' => json_encode($store_node_ids),
                'node_names' => implode(',', $store_node_names),
                'created_at' => $created_at,
            ],
        ];

        Role::insert($roles);
    }
}
