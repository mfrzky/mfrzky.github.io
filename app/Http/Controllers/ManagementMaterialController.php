<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManagementMaterialController extends Controller {
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

        return view('management-material');
    }

    public function indexStockCode(Request $request) {
        if($request->ajax()){
            $getStockCode = DB::table('INV_REFSTOCK')
                            ->where('IDSTOCKTYPE', 'M');

            return DataTables::of($getStockCode)->make(true);
        }

        return view('management-material');
    }

    public function indexStockCodeSearch(Request $request) {
        if($request->ajax()){
            $getStockCode = DB::table('INV_REFSTOCK')
                            ->where('IDSTOCKTYPE', 'M')
                            ->where('IDSTOCK', $request['inputValue'])
                            ->get();

            return DataTables::of($getStockCode)->make(true);
        }

        return view('management-material');
    }

    public function addManagementMaterial(Request $request) {
        $validator = Validator::make($request->all(), [
            'TYPE' => ['required'],
            'SHIFT' => ['required'],
            'STOCKCODE' => ['required'],
            'GRUP' => ['required'],
            // 'PINO' => ['required'],
            'QUANTITY' => ['required'],
        ]);
  
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $idsupplier = session('user')->IDSUPPLIER;
            $getList = DB::table('PCL_REFSUPPLIER')
                        ->where('IDSUPPLIER', $idsupplier)
                        ->first();

            if ($getList->WCCENTRE == null) {
                return response()->json(400);
            } else {
                DB::table('WHS_DOCKET')->insert([
                    'USERNAME'      => session('user')->IDSUPPLIER,
                    'IDDOCKET'      => 0,
                    'IDSTOCK'       => $request->STOCKCODE,
                    'IDSHIFT'       => $request->SHIFT,
                    'QUANTITY'      => $request->QUANTITY,
                    'IDPINO'        => $request->PINO == '' ? '-' : $request->PINO,
                    'TGLDOCKET'     => date('Y-m-d'),
                    'TYPEDOCKET'    => $request->TYPE,
                    'WHSFINISH'     => $getList->WCCENTRE,
                    'WHSCOMP'       => $getList->WCCENTRE,
                    'WCCODE'        => $getList->WCCENTRE,
                    'BULAN'         => date('m'),
                    'TAHUN'         => date('Y'),
                    'LASTUPDATE'    => date('Y-m-d H:i:s'),
                ]);
                    
                return redirect()->route('management-material.index');
            }
        }
    }
}