<?php

namespace App\Repository;

use App\Models\Gallery;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryRepository
{

    public function getData($categorySlug)
    {
        return Gallery::whereHas('galleryCategory', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->orderBy('position', 'asc')->get()->map(function ($data) {
            $file = getStorage($data->image);
            return (object)[
                'id' => $data->id,
                'image' => "data:image/png;base64,{$file}",
                'position' => $data->position
            ];
        });
    }

    public function insert($request, $galleryCategoryId)
    {
        DB::beginTransaction();
        try {
            $lastPosition = Gallery::orderBy('position', 'desc')->value('position');
            $lastPosition = ($lastPosition !== null) ? $lastPosition + 1 : 1;

            Gallery::create([
                'image' => FileUploadService::upload('galleries', $request->file('file')),
                'position' => $lastPosition,
                'category_id' => $galleryCategoryId
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    public function getAllData($request)
    {
        return Gallery::where('category_id', $request->galleryCategoryId)->orderBy('position', 'asc')->get()->map(function ($data) {
            $file = getStorage($data->image);
            return [
                'id' => $data->id,
                'image' => "data:image/png;base64,{$file}",
                'position' => $data->position
            ];
        });
    }

    public function updatePosition($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->positions as $key => $value) {
                Gallery::where('id', $value['id'])->update(['position' => $value['position']]);
            }

            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Gallery position updated successfully'
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function destroyAll($galleryCategoryId)
    {
        DB::beginTransaction();
        try {
            Gallery::where('category_id', (int)$galleryCategoryId)->getQuery()->delete();
            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Gallery deleted all successfully'
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
            $data = Gallery::find($id);
            if (!$data)  return (object)['status' => false, 'message' => 'Gallery not found'];

            $data->delete();
            DB::commit();
            return (object)[
                'status' => true,
                'message' => 'Gallery deleted successfully'
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
