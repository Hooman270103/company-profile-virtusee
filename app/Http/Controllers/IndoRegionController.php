<?php

namespace App\Http\Controllers;

use App\Repository\IndoRegionRepository;
use Illuminate\Http\Request;

class IndoRegionController extends Controller
{
    protected $indoRegionRepository;
    public function __construct(IndoRegionRepository $indoRegionRepository)
    {
        $this->indoRegionRepository = $indoRegionRepository;
    }
    public function getDataProvince(){
        return $this->indoRegionRepository->getProvince();
    }
    public function getDataRegency($id)  {
        return $this->indoRegionRepository->getRegency($id);
    }
    public function getDataDistrict($id)  {
        return $this->indoRegionRepository->getDistrict($id);
    }
    public function getDataVillage($id)  {
        return $this->indoRegionRepository->getVillage($id);
    }
}
