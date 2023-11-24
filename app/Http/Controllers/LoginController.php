<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function check_login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
  
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator);
                Redirect::back()->withInput($request->all())->withErrors($validator);
        } else {
            $checkUser = DB::table('PCL_REFSUPPLIEREMAIL')->where('EMAIL', '=', $request->email)->first();

            if (Hash::check($request->password, $checkUser->PASSWORD)) {
                $values = [
                    'LAST_LOGIN_AT' => Carbon::now()->toDateTimeString(),
                    'LAST_LOGIN_IP' => $request->getClientIp()
                ];
                $updateUser = DB::table('PCL_REFSUPPLIEREMAIL')->where('EMAIL', '=', $request->email)->update($values);
                $userAfterUpdateEmail = DB::table('PCL_REFSUPPLIEREMAIL')->where('EMAIL', '=', $request->email)->first();
                $refSupplier = DB::table('PCL_REFSUPPLIER')->where('IDSUPPLIER', '=', $userAfterUpdateEmail->IDSUPPLIER)->first();
                
                Session::put('supplier', $refSupplier);
                Session::put('user', $userAfterUpdateEmail);
                Session::put('login',TRUE);

                return response()->json(['success' => true], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Login Gagal!'
                ], 401);
            }
        }
    }

    public function changePassword(){
        return view('change-password');
    }

    public function postChangePassword(Request $request){
        $checkUser = DB::table('PCL_REFSUPPLIEREMAIL')->where('EMAIL', '=', session('user')->EMAIL)->first();

        if (Hash::check($request->oldPass, $checkUser->PASSWORD)) {
            $values = [
                'PASSWORD' => Hash::make($request->newPass),
            ];
            $updateUser = DB::table('PCL_REFSUPPLIEREMAIL')->where('EMAIL', '=', session('user')->EMAIL)->update($values);

            return response()->json(['success' => true], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ubah Password Gagal!'
            ], 401);
        }
    }
}