<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
 
class SendEmailController extends Controller {
    public function index(Request $request){
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }

        $id = $request->get('id');
        $idPo = $request->get('idPo');

        $getEmailTo = DB::table('VDR_DAFTAREMAIL')
                    ->join('HRD_REFKARYAWAN2', 'VDR_DAFTAREMAIL.IDKARYAWAN', '=', 'HRD_REFKARYAWAN2.IDKARYAWAN')
                    ->where('VDR_DAFTAREMAIL.STATUS', 1)
                    ->pluck('HRD_REFKARYAWAN2.EMAIL1');

        $getEmailCc = DB::table('VDR_DAFTAREMAIL')
                    ->join('HRD_REFKARYAWAN2', 'VDR_DAFTAREMAIL.IDKARYAWAN', '=', 'HRD_REFKARYAWAN2.IDKARYAWAN')
                    ->where('VDR_DAFTAREMAIL.STATUS', 2)
                    ->pluck('HRD_REFKARYAWAN2.EMAIL1');        

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

        $emailTo = $getEmailTo ?? '';
        $emailCc = $getEmailCc ?? '';
         
        Mail::to(['farizrizky609@gmail.com'])
        ->cc($emailCc)
        ->send(new SendEmail($id, $idPo, $getSjItem));

        return response()->json(['success' => true], 200);
    }
 
}