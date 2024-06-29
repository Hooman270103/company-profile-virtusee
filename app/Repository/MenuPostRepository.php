<?php

namespace App\Repository;

use App\Models\MenuPost;
use Illuminate\Support\Facades\DB;

class MenuPostRepository
{

    public function insert($relationId, $menus, $type)
    {
        DB::beginTransaction();
        try {
            $fieldRelation = $type == 'posts' ? 'post_id' : 'event_id';

            MenuPost::where($fieldRelation, $relationId)->delete();
            foreach ($menus as $key => $value) {
                MenuPost::create([
                    'menu_id' => $value,
                    $fieldRelation => $relationId
                ]);
            }
            DB::commit();
            return (object)[
                'status' => true,
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
