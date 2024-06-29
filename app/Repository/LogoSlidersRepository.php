<?php

namespace App\Repository;

use App\Models\LogoSlider;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;

class LogoSlidersRepository
{
  
    public function getAllData()
    {
        return LogoSlider::orderBy('position', 'asc')->get()->map(function ($data) {
            $file1 = getStorage($data->image);
            return [
                'id' => $data->id,
                'image' => "data:image/png;base64,{$file1}",
                'position' => $data->position
            ];
        });
    }

    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $lastPosition = LogoSlider::orderBy('position', 'desc')->value('position');
            $lastPosition = ($lastPosition !== null) ? $lastPosition + 1 : 1;

            LogoSlider::create([
                'image' => FileUploadService::upload('logo-sliders', $request->file('file')),
                'position' => $lastPosition,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage(); 
        }
    }

    public function updatePosition($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->positions as $key => $value) {
                LogoSlider::where('id', $value['id'])->update(['position' => $value['position']]);
            }

            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Logo Sliders position updated successfully'
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
            LogoSlider::getQuery()->delete();
            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Logo Sliders deleted all successfully'
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
            $data = LogoSlider::find($id);
            if (!$data)  return (object)['status' => false, 'message' => 'Logo Sliders not found'];

            $data->delete();
            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Logo Sliders deleted successfully'
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
