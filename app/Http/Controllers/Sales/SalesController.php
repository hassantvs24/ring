<?php

namespace App\Http\Controllers\Sales;

use App\AccountBook;
use App\Customer;
use App\Discount;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shipment;
use App\VetTex;
use App\Warehouse;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'company', 'productCategory', 'unit')->orderBy('name')->get();
        $customer = Customer::orderBy('name')->get();
        $warehouse = Warehouse::orderBy('name')->get();
        $discount = Discount::orderBy('name')->get();
        $shipment = Shipment::orderBy('name')->get();
        $vat_tax = VetTex::orderBy('name')->get();
        $ac_book = AccountBook::orderBy('name')->get();

        return view('sales.sales')->with(['customer' => $customer, 'products' => $products, 'warehouse' => $warehouse, 'discount' => $discount, 'shipment' => $shipment, 'vat_tax' => $vat_tax, 'ac_book' => $ac_book]);
    }

    public function store(Request $request)
    {
        dd($request->all());

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
    }

    public function destroy($id)
    {
        //
    }

}
