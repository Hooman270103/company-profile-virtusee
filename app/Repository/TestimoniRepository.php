<?php

namespace App\Repository;

use App\Models\Faq;
use App\Enums\Status;
use App\Enums\StatusPost;
use App\Models\Testimoni;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;

class TestimoniRepository
{

    public function getData($request = null)
    {
        $menu = isset($request->data['menu']) ? $request->data['menu'] : null;
        $query = Testimoni::where(['status' => '2', 'published' => '2'])->whereHas('MenuTestimoni', function ($row) use ($menu) {
            $row->where('menu_id', $menu['id']);
        })->get()->map(fn ($item) => $this->setData($item));

        return $query;
    }
    public function setData($item){
        $file = getStorage($item->image);
        return (object)[
            'id' => $item->id,
            'name' => $item->name,
            'title' => $item->title,
            'testimoni' => $item->testimoni,
            'published' => $item->published,
            'status' => $item->status,
            'image' => "data:image/png;base64,{$file}",
        ];
    }
    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $testimoni = Testimoni::create([
                'name' => $request->name,
                'title' => $request->title,
                'testimoni' => $request->content,
                'published' => $request->published,
                'status' => $request->status,
                'image' => $request->image != null ? FileUploadService::upload('testimoni', $request->file('image')) : null
            ]);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $testimoni->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($request, $testimoni)
    {
        DB::beginTransaction();
        try {
            $testimoni->update([
                'name' => $request->name,
                'title' => $request->title,
                'testimoni' => $request->content,
                'published' => $request->published,
                'status' => $request->status,
                'image' => $request->image != null ? FileUploadService::upload('testimoni', $request->file('image')) : $testimoni->image
            ]);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $testimoni->id
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
            Testimoni::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
