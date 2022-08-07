<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Nilai;

class Penilaian extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.penilaian', compact('users'));
    }

    public function fetch()
    {
        $nilai = Nilai::with('users')
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json([
            'nilai' => $nilai
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required',
            'efficency' => 'required',
            'tools' => 'required',
            'procedur'=> 'required', 
            'communication' => 'required'
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
                'user_id' => $request['name'],
                'time' => $request['time'],
                'efficency' => $request['efficency'],
                'tools' => $request['tools'],
                'procedur' => $request['procedur'],
                'communication' => $request['communication']
            ]);
            if($data->wasRecentlyCreated  ){
                $data = [
                    'status' => 'success',
                    'message' => 'Berhasil menambahkan data nilai',
                    'data' => $data,
                ];
            } else { 
                $data = [
                    'status' => 'error',
                    'message' => 'Gagal menambahkan data nilai',
                    'data' => $data,
                ];
            }
        }
        return response()->json($data);
    }

    public function edit($id)
    {
        $nilai = Nilai::with('users')->find($id);
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
                $data->time = $request['time'];
                $data->efficency = $request['efficency'];
                $data->procedur = $request['procedur'];
                $data->tools = $request['tools'];
                $data->communication = $request['communication'];
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
}
