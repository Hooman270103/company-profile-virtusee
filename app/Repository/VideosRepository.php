<?php

namespace App\Repository;

use App\Models\Events;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Enums\Status;
use App\Enums\StatusPost;
use Carbon\Carbon;

class VideosRepository
{
    public function allData($request = null)
    {
        $menu = isset($request->data['menu']) ? $request->data['menu'] : null;
        return Video::where(['status' => '2', 'published' => '2'])->whereHas('MenuVideo', function ($row) use ($menu) {
                $row->where('menu_id', $menu);
            })->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'link' => $item->link,
                'created' => date('d/m/Y H:i', strtotime($item->created_at)),
            ];
        });
    }

    public function insert($request)
    {
        DB::beginTransaction();
        try {

            $video = Video::create([
                'title' => $request['title'],
                'link' => $request['link'],
                'published' => $request['posting'],
                'status' => $request['status'],
            ]);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $video->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($request, $video)
    {
        DB::beginTransaction();
        try {
            $video->update([
                'title' => $request['title'],
                'link' => $request['link'],
                'published' => $request['posting'],
                'status' => $request['status'],
            ]);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $video->id
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
            Video::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
