<?php

namespace App\Repository;

use App\Models\GalleryCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Enums\Status;
use App\Enums\StatusPost;

class GalleryCategoryRepository
{

    public function getData($request = null)
    {
        $menu = isset($request->data['menu']) ? $request->data['menu'] : null;
        return GalleryCategory::with('gallery')->where(['status' => '2', 'published' => '2'])->whereHas('menuGalleryCategory', function ($query) use ($menu) {
            $query->where('menu_id', $menu);
        })
        ->orderBy('position', 'asc')->get();
    }

    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $lastPosition = GalleryCategory::orderBy('position', 'desc')->value('position');
            $lastPosition = ($lastPosition !== null) ? $lastPosition + 1 : 1;

            $galeryCategory = GalleryCategory::create([
                'name' => $request['name'],
                'slug' => Str::slug($request['name']),
                'position' => $lastPosition,
                'published' => $request['posting'],
                'status' => $request['status'],
            ]);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $galeryCategory->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($request, $galeryCategory)
    {
        DB::beginTransaction();
        try {
            $galeryCategory->update([
                'name' => $request['name'],
                'slug' => Str::slug($request['name']),
                'published' => $request['posting'],
                'status' => $request['status'],
            ]);


            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $galeryCategory->id
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
            GalleryCategory::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
