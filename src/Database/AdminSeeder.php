<?php
namespace Encore\Admin\Database;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Seeder;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(\Encore\Admin\Auth\Database\AdminTablesSeeder::class);

        DB::transaction(function()
        {
            Administrator::where('id', 1)->update(['username' => '15665753385','name' => '超级管理员','password' => bcrypt('ssiapp')]);
            Role::where('id', 1)->update(['name' => '管理员']);

            Permission::where('slug', '*')->update(['name' => '全部权限']);
            Permission::where('slug', 'dashboard')->update(['name' => '主面板']);
            Permission::where('slug', 'auth.login')->update(['name' => '登录']);
            Permission::where('slug', 'auth.setting')->update(['name' => '用户设置']);
            Permission::where('slug', 'auth.management')->update(['name' => '权限管理']);

            Menu::where('id', '1')->update(['order' => 1, 'title' => '主面板']);
            Menu::where('id', '2')->update(['order' => 9000, 'title' => '系统管理']);
            Menu::where('id', '3')->update(['order' => 9001, 'title' => '管理员']);
            Menu::where('id', '4')->update(['order' => 9002, 'title' => '角色']);
            Menu::where('id', '5')->update(['order' => 9003, 'title' => '权限']);
            Menu::where('id', '6')->update(['order' => 9004, 'title' => '菜单']);
            Menu::where('id', '7')->update(['order' => 9005, 'title' => '操作日志']);

        });
    }
}

