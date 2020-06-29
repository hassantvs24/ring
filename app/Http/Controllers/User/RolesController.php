<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\UserRoles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $table = UserRoles::orderBy('id', 'DESC')->get();

        return view('stock.units')->with(['table' => $table]);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
