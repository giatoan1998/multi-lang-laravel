<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Exports\ExportUser;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Excel;

// use PDF;
class UserController extends Controller
{
    public function getUsers() {
        $dataUsers = DB::table('users')->select('*')->get()->map(function ($item) {
            return collect($item)->except('password', 'created_at', 'updated_at')->toArray();
        });

        return response()->json($dataUsers);
    }

    public function exportExcel() {
        return Excel::download(new ExportUser, 'user.xlsx');
    }
    // php artisan make:export ExportUser

    public function exportPdf() {
        $users = User::all();
        $pdf = Pdf::loadView('pdf.users', compact('users'));

        return $pdf->download('users.pdf');
    }
}
