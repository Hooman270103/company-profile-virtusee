<?php

namespace App\Repository;

use App\Models\MenuCounter;
use App\Models\MenuLogoSlider;
use App\Models\MenuSection;
use App\Models\MenuTestimoni;
use Illuminate\Support\Facades\DB;

class MenuSectionRepository
{

    public function insert( $id,$request)
    {
        DB::beginTransaction();
        try {
            MenuSection::where('section_id', $id)->delete();
            foreach ($request['menus'] as $key => $value) {
                MenuSection::create([
                    'section_id' => $id,
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
            MenuSection::where('menu_id', $id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
