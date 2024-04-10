<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportUser;
use Illuminate\Support\Facades\Response;
class UserController extends Controller
{
    public function getUsers() {
        $dataUsers = DB::table('users')->select('*')->get()->map(function ($item) {
            return collect($item)->except('password', 'created_at', 'updated_at')->toArray();
        });

        return response()->json($dataUsers);
    }

    public function exportExcel() {
        return \Excel::download(new ExportUser, 'user.xlsx');
    }

    // php artisan make:export ExportUser
}
