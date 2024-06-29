<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileUploadService;

class SummernoteUploadController extends Controller
{
    public function upload(Request $request)
    {
        $result = getStorage(FileUploadService::upload('summernotes', $request->file('image')));

        return response("data:image/png;base64," . $result, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
