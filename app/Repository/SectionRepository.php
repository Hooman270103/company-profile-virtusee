<?php

namespace App\Repository;

use App\Models\Section;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;

class SectionRepository
{
    public function getData($request = null)  {
        $menu = isset($request->data['menu']) ? $request->data['menu'] : null;
        $query = Section::where(['status' => '2', 'published' => '2'])
            ->whereHas('MenuSection', function ($row) use ($menu) {
                $row->where('menu_id', $menu['id']);
            })
            ->orderBy('created_at')->get()->map(fn ($item) => $this->setData($item));
        
        return $query;
    }
    public function setData($item){
        $file = getStorage($item->image);
        return (object)[
            'id' => $item->id,
            'title' => $item->title,
            'image' => "data:image/png;base64,{$file}",
            'description' => $item->description,
            'position' => $item->position,
        ];
    }
    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'title' => $request->title,
                'image' => FileUploadService::upload('section', $request->file('image')),
                'description' => $request->content,
                'published' => (int)$request->posting,
                'status' => (int)$request->status,
                'position' => (int)$request->position
            ];
            $post = Section::create($dataInsert);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $post->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($request, $section)
    {
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'title' => $request->title,
                'description' => $request->content,
                'published' => (int)$request->posting,
                'status' => (int)$request->status,
                'position' => (int)$request->position
            ];

            if ($request->hasFile('image')) {
                $dataUpdate['image'] = FileUploadService::upload('section', $request->file('image'));
            }

            $section->update($dataUpdate);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $section->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function delete($id)  {
        DB::beginTransaction();
        try {
            Section::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
            
}
