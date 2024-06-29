<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SettingRequest;
use App\Repository\SettingRepository;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $settingRepository;
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }
    public function index()  {
        $setting  = Setting::first();
        return view('pages.backend.setting.index', compact('setting'));
    }
    public function update(SettingRequest $request, $id)  {
        $setting = Setting::find($id);
        return $this->settingRepository->updateSetting($setting, $request);
    }

    public function allData() {
        return response()->json($this->settingRepository->getAllData());
    }
}
