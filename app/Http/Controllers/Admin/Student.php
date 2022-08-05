<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class Student extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.student', compact('users'));
    }

    public function fetch()
    {
        $student = User::with('roles')
        ->where('role_id', 2)
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json([
            'student' => $student
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'school' => 'required',
            'email' => 'required',
            'number'=> 'required', 
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
            $data = User::create([
                'name' => $request['name'],
                'school' => $request['school'],
                'email' => $request['email'],
                'phone_number' => $request['number'],
                'password' => Hash::make('student'), 
                'role_id' => 2
            ]);
            if($data->wasRecentlyCreated  ){
                $data = [
                    'status' => 'success',
                    'message' => 'Berhasil menambahkan data siswa',
                    'data' => $data,
                ];
            } else { 
                $data = [
                    'status' => 'error',
                    'message' => 'Gagal menambahkan data siswa',
                    'data' => $data,
                ];
            }
        }
        return response()->json($data);
    }

    public function edit($id)
    {
        $student = User::with('roles')->find($id);
        //List user by user id
        if($student)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditampilkan',
                'student'=> $student,
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
        $data = User::find($id);
        if($data)
        {
            $data->name = $request['name'];
            $data->school = $request['school'];
            $data->email = $request['email'];
            $data->phone_number = $request['phone_number'];
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
        $student = User::find($id);
        if($student)
        {
            $student->delete();
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
