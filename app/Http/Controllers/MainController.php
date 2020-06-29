<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
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
        return Storage::disk('local')->download($files[1]);

      //  return redirect()->back()->with(['message' => 'Database Backup successfully completed.',  'alert-type' => 'success']);

    }

    public function catches(){
        Artisan::call('config:cache');
        Artisan::call('view:cache');
        return 'Catch Successfully Cleared. Go back and try to access your software.';
    }
}
