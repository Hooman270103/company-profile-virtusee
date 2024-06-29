<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\HeroImageSlidesRepository;
use App\Models\HeroImageSliders;

class HeroImageSlidersController extends Controller
{
    protected $heroImageSliders;
    public function __construct(HeroImageSlidesRepository $heroImageSliders)
    {
        $this->heroImageSliders = $heroImageSliders;
    }
    public function index()
    {
        return view('pages.backend.hero-image-sliders.index');
    }

    public function store(Request $request)
    {
        return $this->heroImageSliders->insert($request);
    }

    public function getData(){
        return $this->heroImageSliders->getData();
    }

    public function allData()
    {
        return response()->json($this->heroImageSliders->getAllData());
    }

    public function updatePosition(Request $request)
    {
        return $this->heroImageSliders->updatePosition($request);
    }

    public function destroyAll()
    {
        return $this->heroImageSliders->destroyAll();
    }

    public function destroy($id)
    {
        return $this->heroImageSliders->destroy($id);
    }
}
