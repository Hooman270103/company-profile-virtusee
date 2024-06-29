<?php

namespace App\Repository;

use App\Models\MenuCounter;
use App\Models\MenuLogoSlider;
use Illuminate\Support\Facades\DB;

class MenuCounterRepository
{

    public function insert( $id,$request)
    {
        DB::beginTransaction();
        try {
            MenuCounter::where('counter_id', $id)->delete();
            foreach ($request['menus'] as $key => $value) {
                MenuCounter::create([
                    'counter_id' => $id,
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
            MenuCounter::where('menu_id', $id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
