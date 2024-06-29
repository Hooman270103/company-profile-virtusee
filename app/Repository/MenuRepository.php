<?php

namespace App\Repository;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class MenuRepository
{


    public function getAllMenu()
    {
        return Menu::where('type', '1')->get();
    }
    public function menus()
    {
        return Menu::where(['parent_id' => NULL, 'status' => '2'])->orderBy('position', 'asc')->get()->map(function ($parent) {
            $parent->children = Menu::where(['parent_id' => $parent->id, 'status' => '2'])->orderBy('position', 'asc')->get()->toArray();
            return $parent;
        })->toArray();
    }
    public function storeMenu($data)
    {
        DB::beginTransaction();
        try {
            Menu::create([
                'parent_id' => $data['parent_id'],
                'slug' => $data['slug'] ?? Str::slug($data['name']),
                'name' => $data['name'],
                'status' => $data['status'],
                'type' => $data['type'],
                'link_url' => $data['link_url'] ?? null,
                'position' => $data['position']
            ]);
            DB::commit();
            return redirect()->route('admin.menu.index')->with('success', 'Successfully Added Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to Add Data!');
        }
    }
    public function updateMenu($menu, $data)
    {
        DB::beginTransaction();
        try {
            $menu->update([
                'parent_id' => $data['parent_id'],
                'slug' => $data['slug'] ?? Str::slug($data['name']),
                'name' => $data['name'],
                'status' => $data['status'],
                'type' => $data['type'],
                'link_url' => $data['link_url'] ?? null,
                'position' => $data['position']
            ]);
            DB::commit();
            return redirect()->route('admin.menu.index')->with('success', 'Successfully Updated Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to Update Data!');
        }
    }
    public function deleteMenu($menu)
    {
        DB::beginTransaction();
        try {
            $menu->delete();
            DB::commit();
            return redirect()->route('admin.menu.index')->with('success', 'Successfully Erasing Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to Delete Data!');
        }
    }
}
