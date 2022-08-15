<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class Profile extends Controller
{
    public function index()
    {
        $student = User::where('id', Auth::user()->id)->get();
        return view('student.profile', compact('student'));
    }

    public function update(Request $request)
    {
        $request = $request->all();
        $data = User::find(Auth::user()->id);

        if($data)
        {
            $data->name = $request['name'];
            $data->email = $request['email'];
            $data->school = $request['school'];
            $data->phone_number = $request['phone_number'];
            if($data->password == $request['password']) {
                $data->password = $request['password'];
            } else {
                $data->password = Hash::make($request['password']);
            }
            $data->update();

            $data = [
                'data' => $data,
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ];
        }
        else {
            $data = [
                'data' => $data,
                'status' => 'error',
                'message' => 'Data gagal diubah'
            ];
        }
        return response()->json($data);
    }
}
