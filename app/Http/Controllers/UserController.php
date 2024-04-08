<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUsers() {
        $dataUsers = DB::table('users')->select('*')->get()->map(function ($item) {
            return collect($item)->except('password', 'created_at', 'updated_at')->toArray();
        });

        return response()->json($dataUsers);
    }
}
