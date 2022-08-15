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

    public function edit($id)
    {
        $nilai = Nilai::find($id);
        //List user by user id
        if($nilai)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditampilkan',
                'nilai'=> $nilai,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 'error',
                'message'=>'Data tidak ditemukan'
            ]);
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $data = Nilai::find($id);
        if($data)
        {
            $data->activity = $request['activity'];
            $data->update();
            $data = [
                'data' => $data,
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ];
        }
        else
        { 
            $data = [
                'data' => $data,
                'status' => 'error',
                'message' => 'Gagal mengubah data'
            ];
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        $nilai = Nilai::find($id);
        if($nilai)
        {
            $nilai->delete();
            return response()->json([
                'status'=>'success',
                'message'=>'Berhasil dihapus.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Data tidak ditemukan.'
            ]);
        }
    }
}
