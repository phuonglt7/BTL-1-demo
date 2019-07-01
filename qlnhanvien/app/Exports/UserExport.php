<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all();
    }
     public function headings(): array
    {
        return [
            'UserName',
            'Email',
            'fullname',
            'address',
            'gender',
            'birthday',
            'department_id',
            'permission_id',
            'count_login',
        ];
    }
}