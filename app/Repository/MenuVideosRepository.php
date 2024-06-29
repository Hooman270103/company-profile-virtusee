<?php

namespace App\Repository;

use App\Models\MenuCounter;
use App\Models\MenuLogoSlider;
use App\Models\MenuVideo;
use Illuminate\Support\Facades\DB;

class MenuVideosRepository
{

    public function insert( $id,$request)
    {
        DB::beginTransaction();
        try {
            MenuVideo::where('video_id', $id)->delete();
            foreach ($request['menus'] as $key => $value) {
                MenuVideo::create([
                    'video_id' => $id,
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
            MenuVideo::where('video_id', $id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
