<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;

class PostsRepository
{
    public function getAllData($type){
        return Post::where([
            ['type', $type],
            ['status', '2'],
            ['published', '2']
        ])->orderByDesc('created_at')->get();
    }

    public function getData($request = null)
    {
        $limit = isset($request->limit) ? (int) $request->limit : null;
        $pageId = isset($request->pageId) ? $request->pageId : null;
        $type = isset($request->type) ? ($request->type == 'news' ? 1 : ($request->type == 'articles' ? 2 : ($request->type == 'announcement' ? 3 : 4))) : null;
        $query = Post::where(['type' => $type, 'status' => '2', 'published' => '2'])->whereHas('menu_post', function ($row) use ($request) {
            $row->where('menu_id', $request->pageId);
        })->whereHas('menu_post', function ($row) use ($request) {
            $row->where('menu_id', $request->pageId);
        })->orderByRaw('RAND()');
        
        if ($limit) {
            $result = $query->limit($limit)->get()->map(fn ($item) => $this->setData($item));
            return $result;
        } else {
            $results = $query->paginate(9);
            $results->getCollection()->transform(fn ($item) => $this->setData($item));
            return $results;
        }
    }

    private function setData($item)
    {
        $file = getStorage($item->image);
        return (object)[
            'title' => $item->title,
            'slug' => $item->slug,
            'image' => "data:image/png;base64,{$file}",
            'description' => $item->description,
            'shortDescription' => mb_strimwidth($item->description, 0, 300, "..."),
            'tags' => $item->tags,
            'date' => tglIndoAngka($item->created_at),
            'created_by' => $item->CreatedBy->name
        ];
    }

    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'title' => $request->title,
                'image' => isset($request->image) ? FileUploadService::upload('post', $request->file('image')) : null,
                'slug' =>  isset($request->slug) ? $request->slug : Str::slug($request->title),
                'tags' => json_encode(explode(',', $request->tags)),
                'description' => $request->description,
                'type' => (int)$request->type,
                'published' => (int)$request->posting,
                'status' => (int)$request->status,
            ];
            $post = Post::create($dataInsert);
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

    public function update($post, $request)
    {
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'title' => $request->title,
                'slug' => isset($request->slug) ? $request->slug : Str::slug($request->title),
                'tags' => json_encode(explode(',', $request->tags)),
                'description' => $request->description,
                'type' => (int)$request->type,
                'published' => (int)$request->posting,
                'status' => (int)$request->status,
            ];

            if ($request->hasFile('image')) {
                $dataUpdate['image'] = FileUploadService::upload('post', $request->file('image'));
            }

            $post->update($dataUpdate);
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

    public function delete($post)
    {
        DB::beginTransaction();
        try {
            $post->delete();
            DB::commit();
            return redirect()->route('admin.posts.index')->with('success', 'Delete Data Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Delete Data Failed!');
        }
    }
}
