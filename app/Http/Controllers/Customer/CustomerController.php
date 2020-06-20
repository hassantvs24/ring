<?php

namespace App\Http\Controllers\Customer;

use App\AccountBook;
use App\Customer;
use App\CustomerCategory;
use App\CustomerTransaction;
use App\Http\Controllers\Controller;
use App\Warehouse;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function index()
    {
        $table = Customer::with('zone', 'customerCategory', 'warehouse')->orderBy('id', 'DESC')->get();
        $zone = Zone::orderBy('name', 'ASC')->get();
        $category = CustomerCategory::orderBy('name', 'ASC')->get();
        $warehouse = Warehouse::orderBy('name', 'ASC')->get();
        $ac_book = AccountBook::orderBy('name', 'ASC')->get();
        return view('customer.customer')->with(['table' => $table, 'category' => $category, 'warehouse' => $warehouse, 'zone' => $zone, 'ac_book' => $ac_book]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'string|required|max:191',
            'name' => 'string|required|max:191',
            'contact' => 'string|required|min:11|max:11',
            'balance' => 'numeric|required',
            'customer_categories_id' => 'numeric|required',
            'sells_target' => 'numeric|required',
            'credit_limit' => 'numeric|required',
            'zones_id' => 'numeric|required',
            'warehouses_id' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $table = new Customer();
            $table->code = $request->code ?? mt_rand();
            $table->name = $request->name;
            $table->address = $request->address;
            $table->email = $request->email;
            $table->contact = $request->contact;
            $table->phone = $request->phone;
            $table->alternate_contact = $request->alternate_contact;
            $table->description = $request->description;
            $table->credit_limit = $request->credit_limit ?? 0;
            $table->balance = $request->balance ?? 0;
            $table->sells_target = $request->sells_target ?? 0;
            $table->zones_id = $request->zones_id;
            $table->customer_categories_id = $request->customer_categories_id;
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
            'customer_categories_id' => 'numeric|required',
            'sells_target' => 'numeric|required',
            'credit_limit' => 'numeric|required',
            'zones_id' => 'numeric|required',
            'warehouses_id' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $table = Customer::find($id);
            $table->code = $request->code ?? mt_rand();
            $table->name = $request->name;
            $table->address = $request->address;
            $table->email = $request->email;
            $table->contact = $request->contact;
            $table->phone = $request->phone;
            $table->alternate_contact = $request->alternate_contact;
            $table->description = $request->description;
            $table->credit_limit = $request->credit_limit ?? 0;
            $table->balance = $request->balance ?? 0;
            $table->sells_target = $request->sells_target ?? 0;
            $table->zones_id = $request->zones_id;
            $table->customer_categories_id = $request->customer_categories_id;
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

            Customer::destroy($id);

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.del'));
    }

    public function due_payment(Request $request, $id){

    }

    public function transaction($id){
        $table = CustomerTransaction::where('customers_id', $id)->where('status', 'Active')->orderBy('id', 'DESC')->get();
        return view('customer.transaction')->with(['table' => $table]);
    }

}
