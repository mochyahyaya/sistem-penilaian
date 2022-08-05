<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Nilai;

class LihatNilai extends Controller
{
    public function index()
    {
        $nilai = Nilai::where('user_id', Auth::user()->id)->get();
        return view('student.nilai', compact('nilai'));
    }
}
