<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

class DtsController extends Controller {
    public function indexDts() {
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }
        
        $path = 'D:\\files';

        $files = scandir($path);

        return view('dts', compact('files'));
    }

    public function downloadFile($filename) {
        $file = "D:/files/" . $filename;

        if (file_exists($file)) {
            return response()->download($file, $filename);
        } else {
            return abort(404);
        }
    }
}