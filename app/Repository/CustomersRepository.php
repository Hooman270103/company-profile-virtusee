<?php

namespace App\Repository;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomersRepository
{


    public function insert($request)
    {
        DB::beginTransaction();
        try {
            $data = $request;
            $counter = Customer::create($data);
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

}
