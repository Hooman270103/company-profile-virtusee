<?php

namespace App\Repository;

use App\Models\MenuGallery;
use Illuminate\Support\Facades\DB;

class MenuGalleryCategoryRepository
{

    public function insert($id, $request)
    {
        DB::beginTransaction();
        try {
            MenuGallery::where('galery_category_id', $id)->delete();
            foreach ($request['menus'] as $key => $value) {
                MenuGallery::create([
                    'galery_category_id' => $id,
                    'menu_id' => $value
                ]);
            }
            DB::commit();
            return (object)[
                'status' => true,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            MenuGallery::where('menu_id', $id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
