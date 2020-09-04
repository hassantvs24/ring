<?php

namespace App\Http\Controllers;

use App\Custom\KeyCheck;
use App\Customer;
use App\SellInvoice;
use App\Transaction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    //Toggle Sidebar
    public function saveState()
    {
        if (Session::has('sidebarState')) {
            Session::remove('sidebarState');
        } else {
            Session::put('sidebarState', 'sidebar-xs');
        }
    }

    //Toggle Sidebar

    public function backup(){
        try{
            Artisan::call('backup:clean --disable-notifications');

            Artisan::call('backup:run --only-db --disable-notifications');
        }catch (\Exception $ex) {
            return redirect()->back()->with(['message' => 'Database Backup Failed!!',  'alert-type' => 'error']);
        }

        $files = Storage::disk('local')->files('Laravel');
        return Storage::disk('local')->download(end($files));
    }

    public function activate(){
        $key = new KeyCheck();
        $remain = $key->day_remain();
        return view('auth.key')->with(['remain' => $remain]);
    }

    public function active(Request $request){
        $validator = Validator::make($request->all(), [
            'activation_code' => 'required|string|min:10|max:191|unique:codexes,current_code',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $active = new KeyCheck();
            $active->code($request->activation_code);
            $active->activate();

        }catch (\Exception $ex) {
            return redirect()->back()->with(['message' => 'Invalid Activation! Please Try again.',  'alert-type' => 'error']);
        }

        return redirect()->route('index')->with(['message' => 'Your Software is successfully Activated.',  'alert-type' => 'success']);

    }


    public function catches(){
        Artisan::call('config:cache');
        Artisan::call('view:cache');
        return 'Catch Successfully Cleared. Go back and try to access your software.';
    }


    public function test(){

        /*$table = SellInvoice::all();

        $data = array();
        foreach ($table as $row){
            $row_data['id'] = $row->id;
            $row_data['name'] = $row->customer['name'];

            array_push($data, $row_data);
        }

        dd($data);*/

        /*$csvFile = asset('public/customer4.csv');
        $file_handle = fopen($csvFile, 'r');



        $data = array();
        $i = 1;
        while(! feof($file_handle))
        {
            $row = fgetcsv($file_handle);
            $rowData['name'] = $row[1];
            $rowData['address'] = $row[2];
            $rowData['propietor'] = $row[3];
            $rowData['contact'] = $row[4];

            $table = new Customer();
            $table->code = 2396 + $i;
            $table->name =  $row[1];
            $table->contact_person =  $row[3];
            $table->address =  $row[2];
            $table->contact =  '0'.$row[4];
            $table->customer_categories_id =  1;
            $table->warehouses_id =  1;
            $table->save();

            array_push($data, $rowData);

            $i++;
        }

        fclose($file_handle);

        dd($data);*/
    }
}
