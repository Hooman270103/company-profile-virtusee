<?php

namespace App\Http\Controllers\admin;

use App\Enums\Status;
use App\Enums\PostsType;
use App\Enums\StatusPost;
use App\Models\LogoSlider;
use Illuminate\Http\Request;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\LogoSlidersDataTable;
use App\DataTables\LogoSlidersDetailDataTable;
use App\Http\Requests\LogoSlidersRequest;
use App\Models\LogoSliderDetail;
use App\Repository\LogoSlidersDetailRepository;
use App\Repository\LogoSlidersRepository;
use App\Repository\MenuLogoSlidersRepository;

class LogoSlidersController extends Controller
{
    protected $logoSlidersRepository;
    public function __construct(LogoSlidersRepository $logoSlidersRepository)
    {
        $this->logoSlidersRepository = $logoSlidersRepository;
    }
    public function index()
    {
        return view('pages.backend.logo-sliders.index');
    }
    public function store(Request $request)  {
        return $this->logoSlidersRepository->insert($request);
    }

    public function getData(){
        return $this->logoSlidersRepository->getAllData();
    }

    public function allData()
    {
        return response()->json($this->logoSlidersRepository->getAllData());
    }

    public function updatePosition(Request $request)
    {
        return $this->logoSlidersRepository->updatePosition($request);
    }

    public function destroyAll()
    {
        return $this->logoSlidersRepository->destroyAll();
    }

    public function destroy($id)
    {
        return $this->logoSlidersRepository->destroy($id);
    }
}
