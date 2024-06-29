<?php

namespace App\Repository;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PengaturanRepository {
    
    public function updateMenu($pengaturan, $data)  {
        DB::beginTransaction();
        try {
            $pengaturan->update($data);
          DB::commit();
          return redirect()->back()->with('success', 'Berhasil Mengupdate Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Gagal Mengupdate Data!');
        }
    }
}