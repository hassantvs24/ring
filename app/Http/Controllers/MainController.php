<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

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
}
