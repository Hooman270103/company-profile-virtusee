<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\Customers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\SettingRepository;
use App\Http\Requests\CustomersRequest;
use App\Models\Customer;
use App\Repository\CustomersRepository;
use App\Repository\IndoRegionRepository;

class HomepageController extends Controller
{

    protected $menuRepository;
    protected $settingRepository;
    protected $indoRegionRepository;
    protected $customersRepository;
    public function __construct(MenuRepository $menuRepository, SettingRepository $settingRepository, IndoRegionRepository $indoRegionRepository, CustomersRepository $customersRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->settingRepository = $settingRepository;
        $this->indoRegionRepository = $indoRegionRepository;
        $this->customersRepository = $customersRepository;
    }

    public function pageDisplay($slug)
    {
        $page = Menu::where('slug', $slug)->first();
        $menus = $this->menuRepository->menus();
        $setting = $this->settingRepository->getAllData();
        return view('pages.frontend.home.page', compact('page', 'menus', 'setting'));
    }

    public function kebijakanPrivasi()  {
        $menus = $this->menuRepository->menus();
        $setting = $this->settingRepository->getAllData();
        return view('pages.frontend.home.kebijakan-privasi', compact('menus', 'setting'));
    }   

    public function requestDemo(Customer $customer)  {
        $province = $this->indoRegionRepository->getProvince();
        $menus = $this->menuRepository->menus();
        $setting = $this->settingRepository->getAllData();
        return view('pages.frontend.home.request-demo', compact('menus', 'setting', 'customer', 'province'));
    }
    public function storeRequestDemo(CustomersRequest $request)  {
        // dd($request->all());
        DB::beginTransaction();
        try {
            //code...
            $resultCustomers = $this->customersRepository->insert($request->all());

            if (!$resultCustomers->status) {
                return response()->json(['status' => false, 'message' => $resultCustomers->message], 400);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Request Demo Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', 'Request Demo Failed!');
        }
    }
}
