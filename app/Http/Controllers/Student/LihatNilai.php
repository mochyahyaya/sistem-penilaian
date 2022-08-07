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

    public function fetch()
    {
        $nilai = Nilai::with('users')
        ->where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'DESC')
        ->get();
        return response()->json([
            'nilai' => $nilai
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity' => 'required'
        ]);

        if(!$validated)
        {
            $data = [
                'status' => 'error',
                'meesage' => "Terdapat inputan kosong",
                'data' => ''
            ];
        }

        else
        {
            $data = $request->all();
            $data = Nilai::create([
                'user_id' => Auth::user()->id,
                'time' => 0,
                'efficency' => 0,
                'tools' => 0,
                'procedur' => 0,
                'communication' => 0, 
                'activity' => $request['activity']
            ]);
            if($data->wasRecentlyCreated  ){
                $data = [
                    'status' => 'success',
                    'message' => 'Berhasil menambahkan data aktivitas',
                    'data' => $data,
                ];
            } else { 
                $data = [
                    'status' => 'error',
                    'message' => 'Gagal menambahkan data aktivitas',
                    'data' => $data,
                ];
            }
        }
        return response()->json($data);
    }
}
