<?php

namespace App\Repository;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;

class IndoRegionRepository
{
  public function getProvince(){
      $data = Province::all();
      return $data;
  }
  public function getRegency($id){
    $data = Regency::where('province_id', $id)->get();
    return $data;
  }
  public function getDistrict($id){
    $data = District::where('regency_id', $id)->get();
    return $data;
  }
  public function getVillage($id)  {
    $data = Village::where('district_id', $id)->get();
    return $data;
  }
}
