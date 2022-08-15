<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Nilai;

class Dashboard extends Controller
{
    public function index(){
        $student = User::where('role_id', 2)->count();
        $nilai  = Nilai::count();
        return view('admin.index', compact('nilai', 'student'));
    }
}
