<?php

namespace App\Repository;

use App\Enums\Status;
use App\Models\Counter;
use App\Enums\StatusPost;
use App\Models\LogoSlider;
use Illuminate\Support\Facades\DB;

class CounterRepository
{

    public function getData($request = null){
        $menu = isset($request->data['menu']) ? $request->data['menu'] : null;
        $query = Counter::where(['status' => '2', 'published' => '2'])->whereHas('MenuCounter', function ($row) use ($menu) {
            $row->where('menu_id', $menu);
        })->get();
        return $query;
    }

    public function insert($request)
    {
        DB::beginTransaction();
        try {
           
            foreach ($request['title_data'] as $key => $value) {
                $request['data_counter'][] = array(
                    "title" => $value,
                    "number" => $request['number_data'][$key],
                );
            }
            $counter = Counter::create([
                'title' => $request['title'],
                'published' => $request['posting'],
                'status' => $request['status'],
                'data_counter' => json_encode($request['data_counter']),
            ]);
           
            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $counter->id
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return (object)[
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($request, $counter)
    {
        DB::beginTransaction();
        try {
            
            foreach ($request['title_data'] as $key => $value) {
                $request['data_counter'][] = array(
                    "title" => $value,
                    "number" => $request['number_data'][$key],
                );
            }
           
            $counter->update([
                'title' => $request['title'],
                'published' => $request['posting'],
                'status' => $request['status'],
                'data_counter' => json_encode($request['data_counter']),
            ]);
                

            DB::commit();
            return (object)[
                'status' => true,
                'lastId' => $counter->id
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
            Counter::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
