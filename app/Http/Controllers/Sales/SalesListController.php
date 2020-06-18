<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\SellInvoice;
use Illuminate\Http\Request;

class SalesListController extends Controller
{
    public function index(){
        $table = SellInvoice::with('warehouse', 'vetTex', 'customer', 'shipment', 'discount')->orderByDesc('id')->get();
        return view('sales.sales_list')->with(['table' => $table]);
    }
}
