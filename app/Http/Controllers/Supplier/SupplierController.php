<?php

namespace App\Http\Controllers\Supplier;

use App\AccountBook;
use App\Http\Controllers\Controller;
use App\Supplier;
use App\SupplierCategory;
use App\SupplierTransaction;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{

    public function index()
    {
        $table = Supplier::with('supplierCategory', 'warehouse')->orderBy('id', 'DESC')->get();
        $category = SupplierCategory::orderBy('name', 'ASC')->get();
        $warehouse = Warehouse::orderBy('name', 'ASC')->get();
        $ac_book = AccountBook::orderBy('name', 'ASC')->get();
        return view('supplier.supplier')->with(['table' => $table, 'category' => $category, 'warehouse' => $warehouse, 'ac_book' => $ac_book]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'string|required|max:191',
            'name' => 'string|required|max:191',
            'contact' => 'string|required|min:11|max:11',
            'balance' => 'numeric|required',
            'supplier_categories_id' => 'numeric|required',
            'warehouses_id' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $table = new Supplier();
            $table->code = $request->code ?? mt_rand();
            $table->name = $request->name;
            $table->address = $request->address;
            $table->email = $request->email;
            $table->contact = $request->contact;
            $table->phone = $request->phone;
            $table->alternate_contact = $request->alternate_contact;
            $table->description = $request->description;
            $table->balance = $request->balance ?? 0;
            $table->supplier_categories_id = $request->supplier_categories_id;
            $table->warehouses_id = $request->warehouses_id;
            $table->save();

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.save'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'string|required|max:191',
            'name' => 'string|required|max:191',
            'contact' => 'string|required|min:11|max:11',
            'balance' => 'numeric|required',
            'supplier_categories_id' => 'numeric|required',
            'warehouses_id' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $table = Supplier::find($id);
            $table->code = $request->code ?? mt_rand();
            $table->name = $request->name;
            $table->address = $request->address;
            $table->email = $request->email;
            $table->contact = $request->contact;
            $table->phone = $request->phone;
            $table->alternate_contact = $request->alternate_contact;
            $table->description = $request->description;
            $table->balance = $request->balance ?? 0;
            $table->supplier_categories_id = $request->supplier_categories_id;
            $table->warehouses_id = $request->warehouses_id;
            $table->save();

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.edit'));
    }


    public function destroy($id)
    {
        try{

            Supplier::destroy($id);

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.del'));
    }

    public function due_payment(Request $request, $id){

    }

    public function transaction($id){
        $table = SupplierTransaction::where('suppliers_id', $id)->where('status', 'Active')->orderBy('id', 'DESC')->get();
        return view('supplier.transaction')->with(['table' => $table]);
    }

}
