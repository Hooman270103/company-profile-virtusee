<?php

namespace App\Repository;

use App\Models\Faq;
use App\Enums\Status;
use App\Enums\StatusPost;
use Illuminate\Support\Facades\DB;

class FaqRepository
{

    public function getData($request = null){
        $menu = isset($request->data['menu']) ? $request->data['menu'] : null;
        $query = Faq::where(['status' => '2', 'published' => '2'])
        ->whereHas('MenuFaq', function ($row) use ($menu) {
            $row->where('menu_id', $menu['id']);
        })
        ->orderBy('created_at')->get();

        return $query;
    }

    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $faq = Faq::create($request);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $faq->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($request, $faq)
    {
        DB::beginTransaction();
        try {
            $faq->update($request);
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $faq->id
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
            Faq::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
