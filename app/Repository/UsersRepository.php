<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\DB;


class UsersRepository
{

    public function insert($data)
    {
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $user->assignRole('Admin');
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Created Data Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Created Data Failed!');
        }
    }

    public function update($user, $data)
    {
        DB::beginTransaction();
        try {
            //berikan if jika password kosong maka tidak perlu diupdate
            if (!isset($data['password']) || empty($data['password'])) {
                unset($data['password']);
            }

            $user->update($data);
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Changed Data Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Change Data Failed!');
        }
    }

    public function delete($user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Delete Data Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Delete Data Failed!');
        }
    }
}
