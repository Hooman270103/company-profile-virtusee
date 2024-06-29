<?php

namespace App\Repository;

use App\Models\Heroes;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;

class HeroesRepository
{
    public function getData(){
        $query = Heroes::first();
        $file1 = getStorage($query->image);
        return [
            'id' => $query->id,
            'title' => $query->title,
            'description' => $query->description,
            'image' => "data:image/png;base64,{$file1}",
        ];
    }
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $heroes = Heroes::find($id);
            $heroes->update([
                'title' => $request->title,
                'description' => $request->content,
                'image' => $request->image != null ? FileUploadService::upload('heroes', $request->file('image')) : $heroes->image
            ]);
            DB::commit();
            return (object)[
                'status' => true,
                // 'lastId' => $heroes->id
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
