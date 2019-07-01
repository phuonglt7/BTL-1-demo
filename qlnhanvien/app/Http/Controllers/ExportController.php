<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
       public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
