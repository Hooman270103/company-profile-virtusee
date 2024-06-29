<?php

namespace App\Repository;

use App\Models\MenuCounter;
use App\Models\MenuLogoSlider;
use App\Models\MenuTestimoni;
use Illuminate\Support\Facades\DB;

class MenuTestimoniRepository
{

    public function insert( $id,$request)
    {
        DB::beginTransaction();
        try {
            MenuTestimoni::where('testimoni_id', $id)->delete();
            foreach ($request['menus'] as $key => $value) {
                MenuTestimoni::create([
                    'testimoni_id' => $id,
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
            MenuTestimoni::where('menu_id', $id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
