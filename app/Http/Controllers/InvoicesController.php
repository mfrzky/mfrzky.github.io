<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Invoices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class InvoicesController extends Controller {
    public function indexInvoices(Request $request) {
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }

        $idsupplier = session('user')->IDSUPPLIER;
        if($request->ajax()){
            $getInvoiceList = DB::table('VDR_INVOICE')
                              ->selectRaw('"VDR_INVOICE".*, ("NILAI" + "TAX_PPN") AS TOTAL')
                              ->where('IDSUPPLIER', $idsupplier)
                              ->orderBy('TANGGAL','DESC')
                              ->get();
                              
            return DataTables::of($getInvoiceList)->make(true);
        }

        return view('invoices');
    }

    public function getListInvoicesById(Request $request) {
        $id = $request->get('id');
        $post = DB::table('VDR_INVOICE')->where('IDINVOICE', '=', $id)->get();

        return response()->json($post);
    }

    public function indexItemInvoices(Request $request) {
        $id = $request->get('id');
        $getInvoiceItem = DB::table('VDR_INVOICE')
                        ->join('VDR_INVOICEDETAIL', 'VDR_INVOICE.IDINVOICE', '=', 'VDR_INVOICEDETAIL.IDINVOICE')
                        ->select('VDR_INVOICEDETAIL.*')
                        ->where('VDR_INVOICEDETAIL.IDINVOICE', html_entity_decode($id))
                        ->get();

        return response()->json($getInvoiceItem);
    }

    public function indexRincianInvoices(Request $request) {
        $id = $request->get('id');
        $getRincianItem = DB::table('VDR_SURATJALANITEM')
                        ->join('INV_REFSATUAN', 'VDR_SURATJALANITEM.IDSATUAN', '=', 'INV_REFSATUAN.IDSATUAN')
                        ->select('VDR_SURATJALANITEM.*', 'INV_REFSATUAN.DESKRIPSI AS SATUAN')
                        ->where('VDR_SURATJALANITEM.IDPO', $id)
                        ->get();

        return response()->json($getRincianItem);
    }

    public function indexDaftarSuratJalan(Request $request) {
        if($request->ajax()){
            // $getDaftarSuratJalan = DB::table('VDR_SURATJALAN')
            //                     ->join('WHS_STOCKINITEM', 'VDR_SURATJALAN.IDPO', '=', 'WHS_STOCKINITEM.IDPO')
            //                     ->select('VDR_SURATJALAN.NOSJ', 'VDR_SURATJALAN.TANGGAL', 'VDR_SURATJALAN.IDPO', 'WHS_STOCKINITEM.IDSTOCKIN')
            //                     ->where('VDR_SURATJALAN.FULLBPB', 1)
            //                     ->where('VDR_SURATJALAN.IDSUPPLIER', session('user')->IDSUPPLIER)
            //                     ->whereRaw('VDR_SURATJALAN.NOSJ NOT IN (
            //                         SELECT DISTINCT NOSJ FROM VDR_INVOICEDETAIL
            //                     )')
            //                     ->groupBy('VDR_SURATJALAN.NOSJ', 'VDR_SURATJALAN.TANGGAL', 'VDR_SURATJALAN.IDPO', 'WHS_STOCKINITEM.IDSTOCKIN')
            //                     ->toSql();

             $sql = 'SELECT "VDR_SURATJALAN"."NOSJ", "VDR_SURATJALAN"."TANGGAL", "VDR_SURATJALAN"."IDPO", "WHS_STOCKINITEM"."IDSTOCKIN" 
                    FROM "VDR_SURATJALAN" 
                    INNER JOIN "WHS_STOCKINITEM" ON "VDR_SURATJALAN"."IDPO" = "WHS_STOCKINITEM"."IDPO" 
                    WHERE "VDR_SURATJALAN"."FULLBPB" = 1 
                    AND "VDR_SURATJALAN"."IDSUPPLIER" = ? 
                    AND "VDR_SURATJALAN"."NOSJ" NOT IN (
                        SELECT DISTINCT "NOSJ" FROM "VDR_INVOICEDETAIL"
                    )
                    AND "VDR_SURATJALAN"."TANGGAL" > ?
                    GROUP BY "VDR_SURATJALAN"."NOSJ", "VDR_SURATJALAN"."TANGGAL", "VDR_SURATJALAN"."IDPO", "WHS_STOCKINITEM"."IDSTOCKIN"';

            $getDaftarSuratJalan = DB::select($sql, array(session('user')->IDSUPPLIER, '2022-12-31'));
            
            return DataTables::of($getDaftarSuratJalan)->make(true);
        }
    }

    public function addInvoiceList(Request $request) {
        $validator = Validator::make($request->all(), [
            'IDINVOICE' => ['required'],
            'TANGGAL' => ['required'],
            'IDCURRENCY' => ['required'],
            'TAX_NOFAKTUR' => ['required'],
            'TAX_TANGGAL' => ['required'],
        ]);
  
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $idsupplier = session('user')->IDSUPPLIER;

            DB::table('VDR_INVOICE')->insert([
                'IDSUPPLIER'    => $idsupplier,
                'IDINVOICE'     => $_POST['IDINVOICE'],
                'TANGGAL'       => $_POST['TANGGAL'],
                'IDCURRENCY'    => $_POST['IDCURRENCY'],
                'TAX_NOFAKTUR'  => $_POST['TAX_NOFAKTUR'],
                'TAX_TANGGAL'   => $_POST['TAX_TANGGAL'],
                'STATUS'        => 0,
                'CREATEDAT'     => date('Y-m-d H:i:s'),
            ]);
                
            return redirect()->route('invoices.index');
        }
    }

    public function addInvoiceItem(Request $request) {
        $validator = Validator::make($request->all(), [
            'NOSJ' => ['required'],
        ]);

        $getSuratJalan = DB::table('VDR_SURATJALANITEM')->where('NOSJ', '=', $request->NOSJ)->get();

        $idsupplier = "";
        foreach ($getSuratJalan as $value) {
            $idsupplier = $value->IDSUPPLIER;
        }

        $getPpnRate = collect(\DB::select("
                        SELECT Y2.PPNRATE FROM PCL_PURCHASEORDER A 
                        LEFT JOIN PCL_GETNILAIPO_V1(A.IDPO) Y2 ON (1=1)
                        WHERE A.IDPO=:IDPO AND A.FPPN = 'Y'", 
                    array(
                        'IDPO' => $request->IDPO 
                    )))->first();

        $nilai = DB::table('VDR_SURATJALANITEM')
                ->where('NOSJ', '=', $request->NOSJ)
                ->select(DB::raw('sum(QUANTITY * HARGASATUAN) AS TOTAL_HARGASATUAN'))
                ->first();

        $checkIfExistsDetailItem = DB::table('VDR_INVOICEDETAILITEM')
                                   ->where('NOSJ', '=', $request->NOSJ)
                                   ->first();

        if ($checkIfExistsDetailItem == null) {
            // foreach ($getSuratJalan as $value) {
            //     DB::table('VDR_INVOICEDETAILITEM')->insert([
            //         'IDSUPPLIER'    => $value->IDSUPPLIER,
            //         'IDINVOICE'     => $request->IDINVOICE,
            //         'NOSJ'          => $value->NOSJ,
            //         'IDBARANGMERK'  => $value->IDBARANGMERK,
            //         'IDSTOCK'       => $value->IDSTOCK,
            //         'DESKRIPSI'     => $value->DESKRIPSI,
            //         'QUANTITY'      => $value->QUANTITY,
            //         'HARGASATUAN'   => $value->HARGASATUAN,
            //         'IDSATUAN'      => $value->IDSATUAN,
            //         'IDPO'          => $value->IDPO,
            //     ]);
            // }

            // $getInvoiceDetailItem = DB::table('VDR_INVOICEDETAILITEM')
            //                         ->select('IDSUPPLIER', 'IDINVOICE' , 'NOSJ', 'IDPO', DB::raw('sum(QUANTITY * HARGASATUAN) AS TOTAL_HARGASATUAN'))
            //                         ->where('IDINVOICE', '=', $request->IDINVOICE)
            //                         ->groupBy('IDSUPPLIER', 'IDINVOICE' , 'NOSJ', 'IDPO')
            //                         ->get();
            $getInvoice = DB::table('VDR_INVOICE')
                          ->where('IDINVOICE', '=', htmlspecialchars_decode($request->IDINVOICE))
                          ->get();

            foreach ($getInvoice as $valueDetail) {
                DB::table('VDR_INVOICEDETAIL')->insert([
                    'IDSUPPLIER'    => $idsupplier,
                    'IDINVOICE'     => $valueDetail->IDINVOICE,
                    'NOSJ'          => $request->NOSJ,
                    'IDPO'          => $request->IDPO,
                    'NILAI'         => $nilai->TOTAL_HARGASATUAN,
                    'REFVOUCHER'    => null,
                    'APPROVEACC'    => 'N',
                    'DP_ORDERNO'    => $valueDetail->DP_ORDERNO,
                    'CREATEDAT'     => date('Y-m-d H:i:s'),
                ]);
            }

            return redirect()->route('invoices.index');
        } else {
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            } else {
                DB::table('VDR_INVOICEDETAIL')->insert([
                    'IDSUPPLIER'    => $idsupplier,
                    'IDINVOICE'     => htmlspecialchars_decode($request->IDINVOICE),
                    'NOSJ'          => $request->NOSJ,
                    'IDPO'          => $request->IDPO,
                    'NILAI'         => $nilai->TOTAL_HARGASATUAN,
                    'REFVOUCHER'    => null,
                    'APPROVEACC'    => 'N',
                    'DP_ORDERNO'    => 0,
                    'CREATEDAT'     => date('Y-m-d H:i:s'),
                ]);
    
                $nilaiInvoice = DB::table('VDR_INVOICEDETAIL')
                    ->where('IDINVOICE', '=', htmlspecialchars_decode($request->IDINVOICE))
                    ->select(DB::raw('sum(NILAI) AS TOTAL_NILAI'))
                    ->first();
                $nilaiInvoicePpn = DB::table('VDR_INVOICE')
                    ->where('IDINVOICE', '=', htmlspecialchars_decode($request->IDINVOICE))
                    ->select(DB::raw('sum(TAX_PPN) AS TOTAL_PPN'))
                    ->first();
    
                $updatePpnSuratJalan = [
                    'TAX_PPN'   => $getPpnRate !== null ? $nilaiInvoicePpn->TOTAL_PPN + ($nilai->TOTAL_HARGASATUAN * $getPpnRate->PPNRATE) : 0
                ];
                $updateInvoiceList = DB::table('VDR_SURATJALAN')->where('NOSJ', '=', $request->NOSJ)->update($updatePpnSuratJalan);
    
                $updateNilaiInvoice = [
                    'NILAI'     => $nilaiInvoice->TOTAL_NILAI,
                    'TAX_PPN'   => $getPpnRate !== null ? $nilaiInvoicePpn->TOTAL_PPN + ($nilai->TOTAL_HARGASATUAN * $getPpnRate->PPNRATE) : $nilaiInvoicePpn->TOTAL_PPN
                ];
                $updateInvoiceList = DB::table('VDR_INVOICE')->where('IDINVOICE', '=', $request->IDINVOICE)->update($updateNilaiInvoice);
                    
                return redirect()->route('invoices.index');
            }
        }
    }

    public function editListInvoicesById(Request $request) {
        $id = $request->get('IDINVOICE');
        
        $values = [
            'TANGGAL' => $_POST['TANGGAL'],
            'IDCURRENCY' => $_POST['IDCURRENCY'],
            'TAX_NOFAKTUR' => $_POST['TAX_NOFAKTUR'],
            'TAX_TANGGAL' => $_POST['TAX_TANGGAL'],
        ];

        $post = Invoices::where('IDINVOICE', '=', $id)->update($values);
                
        return redirect()->route('surat-jalan.index');
    }

    public function deleteListInvoices(Request $request) {
        $id = $request->get('id');

        $post = DB::table('VDR_INVOICE')->where('IDINVOICE', '=', $id)->delete();

        return response()->json(200);
    }

    public function deleteItemInvoices(Request $request) {
        $id = $request->get('id');

        $getNilaiDelete = DB::table('VDR_INVOICEDETAIL')
                        ->where('NOSJ', '=', $id)
                        ->where('IDINVOICE', '=', htmlspecialchars_decode($request->IDINVOICE))
                        ->first();

        $getNilaiDeletePpn = DB::table('VDR_SURATJALAN')
                        ->where('NOSJ', '=', $id)
                        ->first();

        $nilaiInvoice = DB::table('VDR_INVOICEDETAIL')
                        ->where('IDINVOICE', '=', htmlspecialchars_decode($request->IDINVOICE))
                        ->select(DB::raw('sum(NILAI) AS TOTAL_NILAI'))
                        ->first();

        $nilaiInvoicePpn = DB::table('VDR_INVOICE')
                        ->where('IDINVOICE', '=', htmlspecialchars_decode($request->IDINVOICE))
                        ->first();

        $updateNilaiInvoice = [
            'NILAI'     => $nilaiInvoice->TOTAL_NILAI - $getNilaiDelete->NILAI,
            'TAX_PPN'   => $nilaiInvoicePpn->TAX_PPN - $getNilaiDeletePpn->TAX_PPN
        ];
        $updateInvoiceList = DB::table('VDR_INVOICE')->where('IDINVOICE', '=', htmlspecialchars_decode($request->IDINVOICE))->update($updateNilaiInvoice);

        $updatePpnSuratJalan = [
            'TAX_PPN'   => 0
        ];
        $updateInvoiceList = DB::table('VDR_SURATJALAN')->where('NOSJ', '=', $id)->update($updatePpnSuratJalan);

        $post = DB::table('VDR_INVOICEDETAIL')->where('NOSJ', '=', $id);
        DB::table('VDR_INVOICEDETAILITEM')->where('NOSJ', '=', $id)->delete();

        $post->delete();

        return response()->json(200);
    }
}