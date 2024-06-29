<?php

namespace App\Repository;

use App\Models\LogoSlider;
use App\Models\MenuLogoSlider;
use App\Models\MenuPost;
use Illuminate\Support\Facades\DB;

class MenuLogoSlidersRepository
{

    public function insert( $id,$request)
    {
        // dd($id);
        DB::beginTransaction();
        try {
            foreach ($request['menus'] as $key => $value) {
                MenuLogoSlider::create([
                    'logo_slider_id' => $id,
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
}
