<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('purchase-orders');
    }

    public function indexSuratJalan() {
        return view('surat-jalan');
    }

    public function indexInvoices() {
        return view('invoices');
    }

    public function indexDts() {
        return view('dts');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('login'));
    }
}