<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Enums\Status;
use App\Enums\StatusPost;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\https;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;

class EventsRepository
{

    public function getData($request = null)
    {
        $limit = isset($request->limit) ? (int) $request->limit : null;
        $slug = isset($request->slug) ? $request->slug : null;
        
        $query = Event::where(['status' => '2', 'published' => '2'])
            ->when($slug, function ($query, $slug) {
                return $query->where('slug', '!=', $slug);
            })
            ->orderByRaw('RAND()');
        if ($limit) {
            return $query->limit($limit)->get()->map(fn ($item) => $this->setData($item));
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
            'location' => $item->location,
            'schedule' => Carbon::createFromFormat('Y-m-d H:i:s', $item->schedule)->format('l, j F Y H:i'),
            'pic' => $item->pic,
            'phone' => $item->phone,
        ];
    }

    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'title' => $request->title,
                'slug' => isset($request->slug) ? $request->slug : Str::slug($request->title),
                'image' => FileUploadService::upload('events', $request->file('image')),
                'description' => $request->description,
                'location' => $request->location,
                'schedule' => $request->schedule,
                'pic' => $request->pic,
                'phone' => $request->phone,
                'published' => (int)$request->posting,
                'status' => (int)$request->status,
            ];
            $event = Event::create($dataInsert);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $event->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($event, $request)
    {
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'title' => $request->title,
                'slug' => isset($request->slug) ? $request->slug : Str::slug($request->title),
                'description' => $request->description,
                'location' => $request->location,
                'schedule' => $request->schedule,
                'pic' => $request->pic,
                'phone' => $request->phone,
                'published' => (int)$request->posting,
                'status' => (int)$request->status,
            ];

            if ($request->hasFile('image')) {
                $dataUpdate['image'] = FileUploadService::upload('events', $request->file('image'));
            }

            $event->update($dataUpdate);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $event->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function delete($event)
    {
        DB::beginTransaction();
        try {
            $event->delete();
            DB::commit();
            return redirect()->route('admin.events.index')->with('success', 'Delete Data Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Delete Data Failed!');
        }
    }
}
