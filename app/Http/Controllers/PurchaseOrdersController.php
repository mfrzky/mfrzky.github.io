<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PurchaseOrdersController extends Controller
{
    public function index(Request $request){
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }
        
        $idsupplier = session('user')->IDSUPPLIER;
        if($request->ajax()){
            $getPoList = DB::table('PCL_PURCHASEORDER')
                         ->where('IDSUPPLIER', $idsupplier)
                         ->orderBy('TANGGALPO','DESC');
            return DataTables::of($getPoList)->make(true);
        }

        return view('purchase-orders');
    }

    public function indexPoById(Request $request) {
        $idPO = $request->get('id');
        $getPoList = DB::table('PCL_PURCHASEORDER')
                     ->join('PCL_PURCHASEORDERITEM', 'PCL_PURCHASEORDER.IDPO', '=', 'PCL_PURCHASEORDERITEM.IDPO')
                     ->where('PCL_PURCHASEORDERITEM.SISAPO', '=', 0)
                     ->get();

        return response()->json($getPoList);
    }

    public function indexItemPo(Request $request) {
        $idPO = $request->get('id');
        $getPoItem = DB::table('PCL_PURCHASEORDERITEM')
                     ->join('PCS_REFBARANG', 'PCL_PURCHASEORDERITEM.IDBARANG', '=', 'PCS_REFBARANG.IDBARANG')
                     ->select('PCL_PURCHASEORDERITEM.*', 'PCS_REFBARANG.BARANGTIPE')
                     ->where('IDPO',$idPO)
                     ->get();

        return response()->json($getPoItem);
    }

    public function indexItemSuratJalan(Request $request) {
        $id = $request->get('id');
        $sql = 'SELECT "VDR_SURATJALAN".*, 
                "VDR_SURATJALANITEM"."DESKRIPSI", 
                "VDR_SURATJALANITEM"."IDBARANGMERK", 
                "VDR_SURATJALANITEM"."QUANTITY" as "QTY_SJ", 
                "C"."QUANTITY" as "QTY_PO", 
                "INV_REFSATUAN"."DESKRIPSI" as "SATUAN" 
                FROM "VDR_SURATJALAN" 
                INNER JOIN "VDR_SURATJALANITEM" ON "VDR_SURATJALAN"."NOSJ" = "VDR_SURATJALANITEM"."NOSJ" 
                INNER JOIN "INV_REFSATUAN" ON "VDR_SURATJALANITEM"."IDSATUAN" = "INV_REFSATUAN"."IDSATUAN" 
                INNER JOIN (
                    SELECT IDPO, SUM(QUANTITY) AS QUANTITY
                    FROM PCL_PURCHASEORDERITEM
                    GROUP BY IDPO
                ) C ON (VDR_SURATJALANITEM.IDPO = C.IDPO)
                WHERE "VDR_SURATJALAN"."IDPO" = ?';

         $getPoItem = DB::select($sql, array($id));

        return response()->json($getPoItem);
    }

    public function indexItemBonPenerimaanBarang(Request $request) {
        $id = $request->get('id');
        $getBpbItem = DB::table('WHS_STOCKIN')
                     ->join('WHS_STOCKINITEM', 'WHS_STOCKIN.IDSTOCKIN', '=', 'WHS_STOCKINITEM.IDSTOCKIN')
                     ->leftJoin('VDR_SURATJALANITEM', 'WHS_STOCKIN.IDPO', '=', 'VDR_SURATJALANITEM.IDPO')
                     ->join('PCS_REFBARANGMERK', 'WHS_STOCKINITEM.IDBARANGMERK', '=', 'PCS_REFBARANGMERK.IDBARANGMERK')
                     ->join('INV_REFSATUAN', 'WHS_STOCKINITEM.IDSATUAN', '=', 'INV_REFSATUAN.IDSATUAN')
                     ->select(
                        'WHS_STOCKIN.*', 
                        'INV_REFSATUAN.DESKRIPSI AS SATUAN', 
                        'VDR_SURATJALANITEM.QUANTITY AS QTY_SJ',
                        'VDR_SURATJALANITEM.NOSJ', 
                        'PCS_REFBARANGMERK.BARANGTIPE',
                        'PCS_REFBARANGMERK.IDBARANG', 
                        'WHS_STOCKINITEM.QUANTITY AS QTY_BPB')
                     ->where('WHS_STOCKIN.IDPO',$id)
                     ->get();

        return response()->json($getBpbItem);
    }

    public function indexItemBonReturBarang(Request $request) {
        $id = $request->get('id');
        $getBrbItem = DB::table('WHS_STOCKRETURN')
                     ->join('WHS_STOCKIN', 'WHS_STOCKRETURN.IDSTOCKIN', '=', 'WHS_STOCKIN.IDSTOCKIN')
                     ->join('WHS_STOCKINITEM', 'WHS_STOCKRETURN.IDSTOCKIN', '=', 'WHS_STOCKINITEM.IDSTOCKIN')
                     ->join('PCS_REFBARANG', 'WHS_STOCKINITEM.IDBARANGMERK', '=', 'PCS_REFBARANG.IDBARANG')
                     ->join('WHS_STOCKRETURNITEM', 'WHS_STOCKRETURN.IDSTOCKRETURN', '=', 'WHS_STOCKRETURNITEM.IDSTOCKRETURN')
                     ->join('INV_REFSATUAN', 'WHS_STOCKRETURNITEM.IDSATUAN', '=', 'INV_REFSATUAN.IDSATUAN')
                     ->select(
                        'WHS_STOCKRETURN.*',
                        'PCS_REFBARANG.BARANGTIPE',
                        'INV_REFSATUAN.DESKRIPSI AS SATUAN',
                        'WHS_STOCKINITEM.QUANTITY AS QTY_BPB',
                        'WHS_STOCKRETURNITEM.QTYRETURN AS QTY_BRB'
                     )
                     ->where('WHS_STOCKRETURN.IDPO',$id)
                     ->get();

        return response()->json($getBrbItem);
    }

    public function logout(Request $request) {
        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }
}