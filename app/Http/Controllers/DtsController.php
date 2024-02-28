<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DtsController extends Controller {
    private function getDirContents($dir, &$results = array()) {
        if (is_dir($dir)) {
            $files = scandir($dir);
        
            foreach ($files as $key => $value) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
                if (!is_dir($path)) {
                    $results[] = basename($path);
                } else if ($value != "." && $value != "..") {
                    $this->getDirContents($path, $results);
                    $results[] = basename($path);
                }
            }
        } else {
            $results = [];
        }
    
        return $results;
    }
    
    public function indexDts() {
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }
        
        $wccentrePath = '\\\\TBPNAS1\\webfolder\\LOG1\\' . session('supplier')->WCCENTRE;

        if (session('supplier')->WCCENTRE) {
            $files = $this->getDirContents($wccentrePath);

            if (empty($files)) {
                return view('dts');
            } else {
                $downloadInfo = DB::table('VDR_DTSDOWNLOAD')
                    ->where('IDSUPPLIER', session('supplier')->IDSUPPLIER)
                    ->where('WCCENTRE', session('supplier')->WCCENTRE)
                    ->select('FILE_NAME', 'DOWNLOAD_AT', 'LAST_DOWNLOAD')
                    ->get();

                $downloadInfoArray = $downloadInfo->pluck('DOWNLOAD_AT', 'FILE_NAME')->toArray();
                $lastDownloadArray = $downloadInfo->pluck('LAST_DOWNLOAD', 'FILE_NAME')->toArray();
                $filesWithDownloadInfo = [];

                foreach ($files as $file) {
                    $fileName = pathinfo($file, PATHINFO_BASENAME);

                    if (array_key_exists($fileName, $downloadInfoArray)) {
                        $filesWithDownloadInfo[$file] = [
                            'DOWNLOAD_AT' => $downloadInfoArray[$fileName],
                            'LAST_DOWNLOAD' => $lastDownloadArray[$fileName],
                        ];
                    } else {
                        $filesWithDownloadInfo[$file] = [
                            'DOWNLOAD_AT' => null,
                            'LAST_DOWNLOAD' => null,
                        ];
                    }
                }

                return view('dts', compact('files', 'filesWithDownloadInfo'));
            }
        } else {
            return view('dts');
        }
    }

    public function downloadFile($filename) {
        $file = "\\\\TBPNAS1\\webfolder\\LOG1\\".session('supplier')->WCCENTRE."\\" . $filename;
        
        if (file_exists($file)) {
            $checkExists = DB::table('VDR_DTSDOWNLOAD')
                            ->where('IDSUPPLIER', session('supplier')->IDSUPPLIER)
                            ->where('WCCENTRE', session('supplier')->WCCENTRE)
                            ->where('FILE_NAME', $filename)
                            ->first();

            if ($checkExists) {
                $conditions = [
                    'IDSUPPLIER' => session('supplier')->IDSUPPLIER,
                    'WCCENTRE' => session('supplier')->WCCENTRE,
                    'FILE_NAME' => $filename,
                ];
                
                $data = [
                    'LAST_DOWNLOAD' => now(),
                ];
                
                DB::table('VDR_DTSDOWNLOAD')->where($conditions)->update($data);
                
                return response()->download($file, $filename);
            } else {
                $currentMaxId = DB::table('VDR_DTSDOWNLOAD')->max('ID');
                $IdValue = $currentMaxId + 1;
    
                DB::table('VDR_DTSDOWNLOAD')->insert([
                    'ID'          => $IdValue,
                    'IDSUPPLIER'  => session('supplier')->IDSUPPLIER,
                    'WCCENTRE'    => session('supplier')->WCCENTRE,
                    'FILE_PATH'   => $file,
                    'FILE_NAME'   => $filename,
                    'DOWNLOAD_AT' => now(),
                    'LAST_DOWNLOAD' => now(),
                ]);
    
                return response()->download($file, $filename);
            }
        } else {
            return abort(404);
        }
    }
}