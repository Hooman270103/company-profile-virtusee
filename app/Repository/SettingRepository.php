<?php

namespace App\Repository;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;


class SettingRepository {
    public function getAllData(){
        $data = Setting::first();
        $file1 = getStorage($data->logo_primary);
        $file2 = getStorage($data->logo_secondary);
        $file3 = getStorage($data->favicon);
        return [
            'id' => $data->id,
            'logo_primary' => "data:image/png;base64,{$file1}",
            'logo_secondary' => "data:image/png;base64,{$file2}",
            'favicon' => "data:image/png;base64,{$file3}",
            'name' => $data->name,
            'tagline' => $data->tagline,
            'description' => $data->description,
            'no_telp' => $data->no_telp,
            'address' => $data->address,
            'maps_location' => $data->maps_location,
            'email' => $data->email,
            'link_instagram' => $data->link_instagram,
            'link_facebook' => $data->link_facebook,
            'link_twitter' => $data->link_twitter,
            'link_tiktok' => $data->link_tiktok,
            'link_linkedin' => $data->link_linkedin,
            'color_primary' => $data->color_primary,
            'color_secondary' => $data->color_secondary
        ];
    }
    public function updateSetting($setting, $request)  {
        DB::beginTransaction();
        try {
            $data = $request->all();

            if (isset($data['color_primary'])) {
                $primaryColor = $this->hexToRgb($data['color_primary']);    
                $brightnessAdjustments = [245,180,120,60,0,-30,-60,-90,-120]; // Variasi kecerahan yang diinginkan
                $data['color_primary'] = [];
                foreach ($brightnessAdjustments as $key => $adjustment) {
                    $offspringColor = $this->adjustBrightness($primaryColor, $adjustment);
                    $prefix = 'primary_' . ($key + 1) . '00';
                    $data['color_primary'][$prefix] = json_encode($this->rgbToHex($offspringColor[0], $offspringColor[1], $offspringColor[2]));
                }       
            }

            if (isset($data['color_secondary'])) {
                $primaryColor = $this->hexToRgb($data['color_secondary']);    
                // Variasi kecerahan yang diinginkan
                $brightnessAdjustments = [245,180,120,60,0,-30,-60,-90,-120];
                $data['color_secondary'] = [];
                foreach ($brightnessAdjustments as $key => $adjustment) {
                    $offspringColor = $this->adjustBrightness($primaryColor, $adjustment);
                    $prefix = 'secondary_' . ($key + 1) . '00';
                    $data['color_secondary'][$prefix] = $this->rgbToHex($offspringColor[0], $offspringColor[1], $offspringColor[2]);
                }
            }
            
            if (isset($data['logo_primary'])) {
                $data['logo_primary'] = FileUploadService::upload('logos', $request->file('logo_primary'));
            }

            if (isset($data['logo_secondary'])) {
                $data['logo_secondary'] =  FileUploadService::upload('logos', $request->file('logo_secondary'));
            }

            if (isset($data['favicon'])) {
                $data['favicon'] =  FileUploadService::upload('logos', $request->file('favicon'));
            }

            $setting->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Successfully Updated Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to Update Data!');
        }
    }

    private function adjustBrightness($rgb, $adjustment)
    {
        return [
            max(0, min(255, $rgb[0] + $adjustment)),
            max(0, min(255, $rgb[1] + $adjustment)),
            max(0, min(255, $rgb[2] + $adjustment))
        ];
    }

    // Fungsi untuk mengonversi hex ke RGB
    private function hexToRgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return [$r, $g, $b];
    }

    // Fungsi untuk mengonversi RGB ke hex
    private function rgbToHex($r, $g, $b)
    {
        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    // Fungsi untuk mendapatkan warna turunan dari skema triadic
    private function generateTriadicColors($primaryColor)
    {
        list($r, $g, $b) = $this->hexToRgb($primaryColor);
        $hsl = $this->rgbToHsl($r, $g, $b);

        $triadic1 = $this->hslToRgb(($hsl[0] + 120) % 360, $hsl[1], $hsl[2]);
        $triadic2 = $this->hslToRgb(($hsl[0] + 240) % 360, $hsl[1], $hsl[2]);

        return [
            $this->rgbToHex($r, $g, $b),
            $this->rgbToHex($triadic1[0], $triadic1[1], $triadic1[2]),
            $this->rgbToHex($triadic2[0], $triadic2[1], $triadic2[2])
        ];
    }

    // Fungsi untuk mengonversi RGB ke HSL
    private function rgbToHsl($r, $g, $b)
    {
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $h = 0;
        $s = 0;
        $l = ($max + $min) / 2;

        if ($max == $min) {
            $h = $s = 0; // achromatic
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }
            $h /= 6;
        }

        return [$h * 360, $s * 100, $l * 100];
    }

    // Fungsi untuk mengonversi HSL ke RGB
    private function hslToRgb($h, $s, $l)
    {
        $h /= 360;
        $s /= 100;
        $l /= 100;
        $r = $g = $b = 0;
        $c = (1 - abs(2 * $l - 1)) * $s;
        $x = $c * (1 - abs(fmod($h * 6, 2) - 1));
        $m = $l - $c / 2;

        if ($h < 1 / 6) {
            $r = $c;
            $g = $x;
        } elseif ($h < 2 / 6) {
            $r = $x;
            $g = $c;
        } elseif ($h < 3 / 6) {
            $g = $c;
            $b = $x;
        } elseif ($h < 4 / 6) {
            $g = $x;
            $b = $c;
        } elseif ($h < 5 / 6) {
            $r = $x;
            $b = $c;
        } else {
            $r = $c;
            $b = $x;
        }

        return [($r + $m) * 255, ($g + $m) * 255, ($b + $m) * 255];
    }
}