<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountActionController extends Controller
{

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'payment_method' => 'string|required|max:20',
            'transaction_hub' => 'string|required',
            'transaction_point' => 'string|required',
            'created_at' => 'required|date_format:d/m/Y',
            'account_books_id' => 'numeric|required',
            'amount' => 'numeric|required|min:1',
            'transaction_type' => 'string|required|min:2|max:3',
            'warehouses_id' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $table = Transaction::find($id);
            $table->amount = $request->amount;
            if($request->transaction_point == 'Account Book'){
                $table->transaction_type = $request->transaction_type;
                $table->transaction_hub = ($request->transaction_type == 'IN' ? 'Add':'Withdraw');
            }
            $table->payment_method = $request->payment_method;
            $table->cheque_number = null_filter($request->cheque_number);
            $table->bank_account_no = null_filter($request->bank_account_no);
            $table->transaction_no = null_filter($request->transaction_no);
            $table->description = null_filter($request->description);
            $table->account_books_id = $request->account_books_id;
            $table->warehouses_id = $request->warehouses_id;
            $table->created_at = $request->created_at;
            $table->save();

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.edit'));
    }


    public function destroy($id)
    {
        try{
            Transaction::destroy($id);

        }catch (\Exception $ex) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.del'));
    }
}
