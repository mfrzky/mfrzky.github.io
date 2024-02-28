<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\SuratJalan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SuratJalanController extends Controller {
    public function indexSuratJalan(Request $request) {
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }
        
        $idsupplier = session('user')->IDSUPPLIER;
        if($request->ajax()){
            $getSjList = DB::table('VDR_SURATJALAN')
                         ->where('IDSUPPLIER', $idsupplier)
                         ->orderBy('TANGGAL','DESC');
            return DataTables::of($getSjList)->make(true);
        }
        
        return view('surat-jalan');
    }

    public function indexSuratJalanListPo(Request $request) {
        $idsupplier = session('user')->IDSUPPLIER;
        if($request->ajax()){
            $sql = 'SELECT
                        B.IDPO,
                        B.TGLDELIVERY,
                        B.TANGGALPO,
                        SUM(A.QUANTITY) - COALESCE(C.QUANTITY, 0) AS TOTAL
                    FROM PCL_PURCHASEORDERITEM A
                    INNER JOIN PCL_PURCHASEORDER B ON (A.IDPO = B.IDPO)
                            LEFT JOIN (
                        SELECT IDPO, SUM(QUANTITY) AS QUANTITY
                        FROM VDR_SURATJALANITEM
                        GROUP BY IDPO
                    ) C ON (A.IDPO = C.IDPO)
                    INNER JOIN PCS_PURCHASEORDER D ON A.IDPO = D.IDPO
                    WHERE B.IDSUPPLIER = ?
                    AND D.WEBSTATUS = ?
                    GROUP BY B.IDPO, B.TGLDELIVERY, B.TANGGALPO, C.QUANTITY
                    HAVING SUM(A.QUANTITY) - COALESCE(C.QUANTITY, 0) > 0
                    ORDER BY B.TANGGALPO DESC';

            $getPoList = DB::select($sql, array($idsupplier, 'O'));
            return DataTables::of($getPoList)->make(true);
        }

        return response()->json($getPoList);
    }

    public function indexItemSuratJalan(Request $request) {
        $id = $request->get('id');
        $getSjItem = DB::table('VDR_SURATJALAN')
                     ->join('VDR_SURATJALANITEM', 'VDR_SURATJALAN.NOSJ', '=', 'VDR_SURATJALANITEM.NOSJ')
                     ->join('INV_REFSATUAN', 'VDR_SURATJALANITEM.IDSATUAN', '=', 'INV_REFSATUAN.IDSATUAN')
                     ->select(
                        'VDR_SURATJALAN.*', 
                        'VDR_SURATJALANITEM.DESKRIPSI', 
                        'VDR_SURATJALANITEM.IDBARANGMERK', 
                        'VDR_SURATJALANITEM.QUANTITY AS QTY_SJ',
                        'INV_REFSATUAN.DESKRIPSI AS SATUAN')
                     ->where('VDR_SURATJALAN.NOSJ', '=', $id)
                     ->get();

        foreach ($getSjItem as $key => $item) {
            $getSjItem[$key] = array_map('utf8_encode', (array) $item);
        }

        return response()->json($getSjItem);
    }

    public function indexItemBonPenerimaanBarang(Request $request) {
        $id = $request->get('id');
        $sql = 'SELECT
                    "WHS_STOCKIN".*,
                    "INV_REFSATUAN"."DESKRIPSI" AS "SATUAN",
                    "PCS_REFBARANGMERK"."BARANGTIPE",
                    "PCS_REFBARANGMERK"."IDBARANG",
                    "D"."QUANTITY" AS "QTY_BPB",
                    "C"."QUANTITY" AS "QTY_SJ"
                FROM WHS_STOCKIN
                INNER JOIN (
                    SELECT NOSJ, IDBARANGMERK, SUM(QUANTITY) AS QUANTITY
                    FROM VDR_SURATJALANITEM
                    GROUP BY NOSJ, IDBARANGMERK
                ) C ON (WHS_STOCKIN.NOSJ = C.NOSJ)
                INNER JOIN (
                    SELECT IDSTOCKIN, IDBARANGMERK, IDSATUAN, SUM(QUANTITY) AS QUANTITY
                    FROM WHS_STOCKINITEM
                    GROUP BY IDSTOCKIN, IDBARANGMERK, IDSATUAN
                ) D ON (WHS_STOCKIN.IDSTOCKIN = D.IDSTOCKIN AND C.IDBARANGMERK = D.IDBARANGMERK)
                INNER JOIN "PCS_REFBARANGMERK" ON D."IDBARANGMERK" = "PCS_REFBARANGMERK"."IDBARANGMERK"
                INNER JOIN "INV_REFSATUAN" ON D."IDSATUAN" = "INV_REFSATUAN"."IDSATUAN"
                WHERE WHS_STOCKIN."NOSJ" = ?';
        $getBpbItem = DB::select($sql, array($id));

        return response()->json($getBpbItem);
    }

    public function getListSuratJalanById(Request $request) {
        $id = $request->get('id');

        $post = DB::table('VDR_SURATJALAN')->where('NOSJ', '=', $id)->get();

        return response()->json($post);
    }
    
    public function addListSuratJalan(Request $request) {
        $idsupplier = session('user')->IDSUPPLIER;
        $validator = Validator::make($request->all(), [
            'TANGGAL' => ['required'],
            'NOSJ' => ['required'],
            'IDPO' => ['required'],
        ]);
  
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $checkSJ = DB::table('VDR_SURATJALAN')->where('NOSJ', $request->NOSJ)->first();
            
            if ($checkSJ) {
                return response()->json([
                    'error' => 'NO SJ Sudah ada!'
                ]);
            }

            $sql = 'SELECT
                        B.IDPO,
                        B.TGLDELIVERY,
                        B.TANGGALPO,
                        SUM(A.QUANTITY) - COALESCE(C.QUANTITY, 0) AS TOTAL
                    FROM PCL_PURCHASEORDERITEM A
                    INNER JOIN PCL_PURCHASEORDER B ON (A.IDPO = B.IDPO)
                            LEFT JOIN (
                        SELECT IDPO, SUM(QUANTITY) AS QUANTITY
                        FROM VDR_SURATJALANITEM
                        GROUP BY IDPO
                    ) C ON (A.IDPO = C.IDPO)
                    INNER JOIN PCS_PURCHASEORDER D ON A.IDPO = D.IDPO
                    WHERE B.IDSUPPLIER = ?
                    AND D.WEBSTATUS = ?
                    GROUP BY B.IDPO, B.TGLDELIVERY, B.TANGGALPO, C.QUANTITY
                    HAVING SUM(A.QUANTITY) - COALESCE(C.QUANTITY, 0) > 0
                    ORDER BY B.TANGGALPO DESC';
                    
            $getPoList = DB::select($sql, array($idsupplier, 'O'));
            
            $values = array_column($getPoList, 'IDPO');
            if (in_array($request->IDPO, $values)) {
                $idsupplier = session('user')->IDSUPPLIER;

                $postDate = $_POST['TANGGAL'];
                $date = str_replace('/', '-', $postDate);
    
                DB::table('VDR_SURATJALAN')->insert([
                    'IDSUPPLIER' => $idsupplier,
                    'NOSJ' => $request->NOSJ,
                    'TANGGAL' => date('Y-m-d', strtotime($date)),
                    'IDPO' => $request->IDPO,
                    'STATUS' => 0,
                    'SEND_EMAIL' => 1,
                    'CREATEDAT' => date('Y-m-d H:i:s'),
                ]);

                return redirect()->route('surat-jalan.index');
            } else {
                return response()->json(400);
            }
        }
    }

    public function getItemSuratJalanById(Request $request) {
        // $getItemtSj = DB::table('PCL_PURCHASEORDERITEM')
        //             ->select('PCL_PURCHASEORDERITEM.IDBARANGMERK','PCS_REFBARANG.BARANGTIPE','PCL_PURCHASEORDERITEM.QUANTITY','PCL_PURCHASEORDERITEM.IDSATUAN','PCL_PURCHASEORDERITEM.HARGA', 'PCL_PURCHASEORDERITEM.SISAPO')
        //             ->join('PCS_REFBARANG', 'PCS_REFBARANG.IDBARANG', '=', 'PCL_PURCHASEORDERITEM.IDBARANG')
        //             ->where('PCL_PURCHASEORDERITEM.SISAPO', '>', 0)
        //             ->whereRaw('PCL_PURCHASEORDERITEM.QUANTITY <= PCL_PURCHASEORDERITEM.SISAPO')
        //             ->where('PCL_PURCHASEORDERITEM.IDPO', $request->get('id'))
        //             ->orderBy('PCL_PURCHASEORDERITEM.IDBARANGMERK', 'ASC')
        //             ->toSql();
        $sql = 'SELECT
            "PCL_PURCHASEORDERITEM"."IDBARANGMERK",
            "PCS_REFBARANG"."BARANGTIPE",
            "PCL_PURCHASEORDERITEM"."QUANTITY",
            "PCL_PURCHASEORDERITEM"."IDSATUAN",
            "PCL_PURCHASEORDERITEM"."HARGA",
            "PCL_PURCHASEORDERITEM"."SISAPO"
        FROM
            "PCL_PURCHASEORDERITEM"
        INNER JOIN
            "PCS_REFBARANG" ON "PCS_REFBARANG"."IDBARANG" = "PCL_PURCHASEORDERITEM"."IDBARANG"
        WHERE
            "PCL_PURCHASEORDERITEM"."SISAPO" > 0
            AND "PCL_PURCHASEORDERITEM"."QUANTITY" <= "PCL_PURCHASEORDERITEM"."SISAPO"
            AND "PCL_PURCHASEORDERITEM"."IDPO" = ?
            AND NOT EXISTS (
                SELECT 1
                FROM "VDR_SURATJALANITEM"
                WHERE
                    "VDR_SURATJALANITEM"."IDBARANGMERK" = "PCL_PURCHASEORDERITEM"."IDBARANGMERK"
                    AND "VDR_SURATJALANITEM"."IDPO" = "PCL_PURCHASEORDERITEM"."IDPO"
            )
        ORDER BY
            "PCL_PURCHASEORDERITEM"."IDBARANGMERK" ASC';

        $getItemtSj = DB::select($sql, array($request->get('id')));

        return response()->json($getItemtSj);
    }

    public function addItemSuratJalan(Request $request) {
        $idsupplier = session('user')->IDSUPPLIER;

        if (empty($request->QUANTITY)) {
            $getItemtSj = DB::table('PCL_PURCHASEORDERITEM')
                    ->select('PCL_PURCHASEORDERITEM.IDBARANGMERK','PCS_REFBARANG.BARANGTIPE','PCL_PURCHASEORDERITEM.QUANTITY','PCL_PURCHASEORDERITEM.IDSATUAN','PCL_PURCHASEORDERITEM.HARGA')
                    ->join('PCS_REFBARANG', 'PCS_REFBARANG.IDBARANG', '=', 'PCL_PURCHASEORDERITEM.IDBARANG')
                    ->where('PCL_PURCHASEORDERITEM.SISAPO', '>', 0)
                    ->whereRaw('PCL_PURCHASEORDERITEM.QUANTITY <= PCL_PURCHASEORDERITEM.SISAPO')
                    ->where('PCL_PURCHASEORDERITEM.IDPO', $request->IDPO)
                    ->orderBy('PCL_PURCHASEORDERITEM.IDBARANGMERK', 'ASC')
                    ->get();
            
            foreach ($getItemtSj as $key => $value) {
                DB::table('VDR_SURATJALANITEM')->insert([
                    'IDSUPPLIER'    => $idsupplier,
                    'NOSJ'          => $request->NOSJ,
                    'IDBARANGMERK'  => $value->IDBARANGMERK,
                    'DESKRIPSI'     => $value->BARANGTIPE,
                    'QUANTITY'      => $value->QUANTITY,
                    'HARGASATUAN'   => $value->HARGA,
                    'IDSATUAN'      => $value->IDSATUAN,
                    'IDPO'          => $request->IDPO,
                ]);
            }
        } else {
            $getItemtSj = DB::table('PCL_PURCHASEORDERITEM')
                        ->select('PCL_PURCHASEORDERITEM.QUANTITY', 'PCL_PURCHASEORDERITEM.IDBARANGMERK', 'PCL_PURCHASEORDERITEM.IDPO')
                        ->where('PCL_PURCHASEORDERITEM.IDPO', $request->IDPO)
                        ->where('PCL_PURCHASEORDERITEM.IDBARANGMERK', $request->IDBARANGMERK)
                        ->first();

            if ((int)$request->QUANTITY > (int)$getItemtSj->QUANTITY) {
                return response()->json(400);
            } else {
                DB::table('VDR_SURATJALANITEM')->insert([
                    'IDSUPPLIER'    => $idsupplier,
                    'NOSJ'          => $request->NOSJ,
                    'IDBARANGMERK'  => $request->IDBARANGMERK,
                    'DESKRIPSI'     => $request->BARANGTIPE,
                    'QUANTITY'      => $request->QUANTITY,
                    'HARGASATUAN'   => (int)$request->HARGA,
                    'IDSATUAN'      => $request->IDSATUAN,
                    'IDPO'          => $request->IDPO,
                ]);
            }
        }

        return response()->json(200);
    }
    
    public function editListSuratJalanById(Request $request) {
        $id = $request->get('NOSJ');

        $values = [
            'TANGGAL' => $_POST['TANGGAL'],
        ];

        $post = SuratJalan::where('NOSJ', '=', $id)->update($values);
                
        return redirect()->route('surat-jalan.index');
    }

    public function getDataItemById(Request $request) {
        $id = $request->get('id');
        $idBarangMerk = $request->get('idBarangMerk');
        $getSjItem = DB::table('VDR_SURATJALAN')
                     ->join('VDR_SURATJALANITEM', 'VDR_SURATJALAN.NOSJ', '=', 'VDR_SURATJALANITEM.NOSJ')
                     ->join('INV_REFSATUAN', 'VDR_SURATJALANITEM.IDSATUAN', '=', 'INV_REFSATUAN.IDSATUAN')
                     ->select(
                        'VDR_SURATJALAN.*', 
                        'VDR_SURATJALANITEM.DESKRIPSI', 
                        'VDR_SURATJALANITEM.IDBARANGMERK', 
                        'VDR_SURATJALANITEM.QUANTITY AS QTY_SJ',
                        'INV_REFSATUAN.DESKRIPSI AS SATUAN')
                     ->where('VDR_SURATJALAN.NOSJ', '=', $id)
                     ->where('VDR_SURATJALANITEM.IDBARANGMERK', '=', $idBarangMerk)
                     ->get();

        return response()->json($getSjItem);
    }

    public function editItemSuratJalanById(Request $request) {
        $id = $request->get('NOSJ');
        $idBarangMerk = $request->get('IDBARANGMERK');

        $values = [
            'QUANTITY' => $_POST['QTY_SJ'],
        ];

        $checkQuantity = DB::table('VDR_SURATJALANITEM')
                        ->select('VDR_SURATJALANITEM.QUANTITY')
                        ->join('PCL_PURCHASEORDERITEM', 'PCL_PURCHASEORDERITEM.IDPO', '=', 'VDR_SURATJALANITEM.IDPO')
                        ->where('VDR_SURATJALANITEM.NOSJ', $id)
                        ->where('VDR_SURATJALANITEM.IDBARANGMERK', $idBarangMerk)
                        ->first();
        
        if ($values['QUANTITY'] > $checkQuantity->QUANTITY) {
            return response()->json(400);
        } else {
            try { 
                $post = DB::table('VDR_SURATJALANITEM')
                        ->where('NOSJ', '=', $id)
                        ->where('IDBARANGMERK', '=', $idBarangMerk)
                        ->update($values);
                        
                return response()->json(200);
             } catch(\Illuminate\Database\QueryException $ex){ 
                $errorMessage = $ex->getMessage(); 

                if (stripos($errorMessage, 'TIDAK BISA EDIT ATAU HAPUS, ITEM SJ INI SUDAH DITERIMA (DIINPUT DI BPB)') !== false) {
                    return response()->json(['message' => 'tidak bisa edit atau hapus']);
                }
            }
        }
    }

    public function deleteListSuratJalanById(Request $request) {
        try { 
            $id = $request->get('id');

            $post = DB::table('VDR_SURATJALAN')->where('NOSJ', '=', $id)->delete();

            return response()->json(200);
         } catch(\Illuminate\Database\QueryException $ex){ 
            $errorMessage = $ex->getMessage(); 

            if (stripos($errorMessage, 'TIDAK BISA EDIT ATAU HAPUS, DATA SJ INI SUDAH DITERIMA (DIINPUT DI BPB)') !== false) {
                return response()->json(['message' => 'tidak bisa edit atau hapus']);
            }
        }
    }

    public function deleteItemSuratJalanById(Request $request) {
        $id = $request->get('id');
        $idBarangMerk = $request->get('idBarangMerk');

        $post = DB::table('VDR_SURATJALANITEM')->where('NOSJ', '=', $id)->where('IDBARANGMERK', '=', $idBarangMerk)->delete();

        return response()->json(200);
    }
}