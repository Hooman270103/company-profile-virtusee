<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repository\GalleryRepository;
use Illuminate\Http\Request;
use App\Repository\MenuRepository;
use App\Repository\SettingRepository;
use App\Models\GalleryCategory;

class GalleryController extends Controller
{
    protected $galleryRepository;
    protected $menuRepository;
    protected $settingRepository;
    public function __construct(GalleryRepository $galleryRepository, MenuRepository $menuRepository, SettingRepository $settingRepository)
    {
        $this->galleryRepository = $galleryRepository;
        $this->menuRepository = $menuRepository;
        $this->settingRepository = $settingRepository;
    }
    public function index($galleryCategoryId, $galleryCategoryName)
    {
        return view('pages.backend.gallery.index', compact('galleryCategoryId', 'galleryCategoryName'));
    }
    public function store(Request $request, $galleryCategoryId)
    {
        return $this->galleryRepository->insert($request, $galleryCategoryId);
    }

    public function allData(Request $request)
    {
        return response()->json($this->galleryRepository->getAllData($request));
    }

    public function updatePosition(Request $request)
    {
        return $this->galleryRepository->updatePosition($request);
    }

    public function destroyAll($galleryCategoryId)
    {
        return $this->galleryRepository->destroyAll($galleryCategoryId);
    }

    public function destroy($id)
    {
        return $this->galleryRepository->destroy($id);
    }

    public function detailData($categorySlug)
    {
        return view('pages.frontend.home.components.photos.detail', [
            'categoryName' => GalleryCategory::where('slug', $categorySlug)->first()->name,
            'photos' => $this->galleryRepository->getData($categorySlug),
            'menus' => $this->menuRepository->menus(),
            'setting' => $this->settingRepository->getAllData(),
        ]);
    }
}
