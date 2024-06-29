<?php

namespace App\Repository;

use App\Models\HeroImageSlider;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroImageSlidesRepository
{

    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $lastPosition = HeroImageSlider::orderBy('position', 'desc')->value('position');
            $lastPosition = ($lastPosition !== null) ? $lastPosition + 1 : 1;

            HeroImageSlider::create([
                'image' => FileUploadService::upload('hero-image-sliders', $request->file('file')),
                'position' => $lastPosition,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    public function getData()  {
        $query = HeroImageSlider::orderBy('position', 'asc')->get();
        return $query;
    }

    public function getAllData()
    {
        return HeroImageSlider::orderBy('position', 'asc')->get()->map(function ($data) {
            $file1 = getStorage($data->image);
            return [
                'id' => $data->id,
               'image' => "data:image/png;base64,{$file1}",
                'position' => $data->position
            ];
        });
    }

    public function updatePosition($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->positions as $key => $value) {
                HeroImageSlider::where('id', $value['id'])->update(['position' => $value['position']]);
            }

            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Hero slider position updated successfully'
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function destroyAll()
    {
        DB::beginTransaction();
        try {
            HeroImageSlider::getQuery()->delete();
            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Hero slider deleted all successfully'
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = HeroImageSlider::find($id);
            if (!$data)  return (object)['status' => false, 'message' => 'Hero slider not found'];

            $data->delete();
            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'hero slider deleted successfully'
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
