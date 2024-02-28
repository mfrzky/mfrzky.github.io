<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index(Request $request) {
        if(!session('user')){
            return Redirect::route('login')->with('error', 'Silahkan login kembali!');
        }
        
        if($request->ajax()){
            $listVendor = DB::table('PCL_REFSUPPLIEREMAIL')
                          ->where('EMAIL', '!=', session('user')->EMAIL)
                        //   ->where('IS_ADMIN', null)
                          ->get();
            
            return DataTables::of($listVendor)->make(true);
        }
                
        return view('admin.admin');
    }

    public function changeEmailVendor(Request $request) {
        $values = [
            'PASSWORD' => Hash::make($request['newPassword']),
        ];
        $updateUser = DB::table('PCL_REFSUPPLIEREMAIL')->where('EMAIL', '=', $request['email'])->update($values);

        return response()->json(['success' => true], 200);
    }
}