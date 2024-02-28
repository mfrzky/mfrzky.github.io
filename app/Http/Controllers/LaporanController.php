<?php

namespace App\Http\Controllers;

use Response;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LaporanController extends Controller {
    public function index(Request $request) {
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }

        $idsupplier = session('user')->IDSUPPLIER;
        if($request->ajax()){
            $getList = DB::table('WHS_DOCKET')
                         ->join('PCL_REFSUPPLIER', "WHS_DOCKET.WHSCOMP", "=", 'PCL_REFSUPPLIER.WCCENTRE')
                         ->where('IDSUPPLIER', $idsupplier);

            return DataTables::of($getList)->make(true);
        }

        $getWcCentre = DB::table('PCL_REFSUPPLIER')
                       ->where('IDSUPPLIER', $idsupplier)
                       ->select('WCCENTRE')
                       ->first();

        return view('laporan', compact('getWcCentre'));
    }

    public function indexStockCode(Request $request) {
        if($request->ajax()){
            $getStockCode = DB::table('INV_REFSTOCK')
                            ->where('IDSTOCKTYPE', 'M');

            return DataTables::of($getStockCode)->make(true);
        }

        return view('management-material');
    }
}