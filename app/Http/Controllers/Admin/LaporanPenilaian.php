<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class LaporanPenilaian extends Controller
{
    public function index()
    {
        // $laporan = DB::table('penilaian')
        // ->select(DB::raw("
        //     name, 
        //     AVG(time) as time,
        //     AVG(efficency) as efficency,
        //     AVG(tools) as tools,
        //     AVG(procedur) as procedur,
        //     AVG(communication) as communication
        // "))
        // ->join('users', 'penilaian.user_id', '=', 'users.id')
        // ->groupBy('name')
        // ->get();

        // dd($laporan);
        return view('admin.laporan-penilaian');
    }

    public function fetch()
    {
        $laporan = DB::table('penilaian')
        ->select(DB::raw("
            name, school,
            AVG(time) as time,
            AVG(efficency) as efficency,
            AVG(tools) as tools,
            AVG(procedur) as procedur,
            AVG(communication) as communication
        "))
        ->join('users', 'penilaian.user_id', '=', 'users.id')
        ->groupBy('name', 'school')
        ->orderBy('name', 'ASC')
        ->get();

        return response()->json([
            'laporan' => $laporan
        ]);
    }
    }


