<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\PurchaseInvoice;
use Illuminate\Http\Request;

class PurchaseListController extends Controller
{
    public function index(){
        $table = PurchaseInvoice::with('warehouse', 'vetTex', 'supplier', 'shipment', 'discount')->orderByDesc('id')->get();

        return view('purchase.purchase_list')->with(['table' => $table]);
    }
}
