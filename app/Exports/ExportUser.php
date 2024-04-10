<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class ExportUser implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->select('*')->get()->map(function ($item) {
            return collect($item)->except('password', 'created_at', 'updated_at')->toArray();
        });
    }

    // public function map($users): array
    // {
    //     return [
    //         $users->id,
    //         $users->name,
    //         $users->email,
    //         $users->created_at,
    //     ];
    // }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Create Date',
        ];
    }
}
