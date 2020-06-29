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

        $validator = Validator::make($request->all(), [
            'payment_method' => 'string|required|max:20',
            'account_books_id' => 'numeric|required',
            'amount' => 'numeric|required|min:1',
            'warehouses_id' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $table = new CustomerTransaction();
            $table->payment_type = 'Add Balance';
            $table->transaction_type = 'IN';
            $table->amount = $request->amount;
            $table->customers_id = $id;
            $table->payment_method = $request->payment_method;
            $table->account_books_id = $request->account_books_id;
            $table->cheque_number = null_filter($request->cheque_number);
            $table->bank_account_no = null_filter($request->bank_account_no);
            $table->transaction_no = null_filter($request->transaction_no);
            $table->description = null_filter($request->description);
            $table->warehouses_id = $request->warehouses_id;
            $table->save();

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.save'));
    }

    public function edit_due_payment(Request $request, $id, $customer){
        dd($request->all());
    }

    public function delete_due_payment($id){
        try{

            CustomerTransaction::destroy($id);

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.del'));
    }


    public function transaction($id){
        $customer = Customer::find($id);
        $warehouse = Warehouse::orderBy('name', 'ASC')->get();
        $ac_book = AccountBook::orderBy('name', 'ASC')->get();
        $table = CustomerTransaction::with('accountBook', 'customer', 'warehouse')->where('customers_id', $id)->where('status', 'Active')->orderBy('id', 'DESC')->get();
        return view('customer.transaction')->with(['table' => $table, 'warehouse' => $warehouse, 'customer' => $customer, 'ac_book' => $ac_book]);
    }

}
