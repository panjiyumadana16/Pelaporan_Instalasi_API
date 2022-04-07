<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Admin;
use App\Models\Manager;
use App\Models\Programmer;
use App\Models\Technician;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('testToken')->plainTextToken;
            $success['name'] =  $authUser->name;
            $success['role'] = $authUser->role;
            $user = User::where('email', $request->email)->first();

            // return $this->($success, 'Selamat Datang ' . $success['name']);
            return response()->json([
                'user' => $success,
            ]);
        } else {
            return $this->sendError('Gagal!', ['error' => 'Username dan password salah!']);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('testToken')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }

    public function getIdUser($nama){
        $admin = Admin::where('name', $nama)->value('id_admin');
        $manager = Manager::where('name', $nama)->value('id_manager');
        $programmer = Programmer::where('name', $nama)->value('id_programmer');
        $teknisi = Technician::where('name', $nama)->value('id_technician');

        if(!is_null($admin)){
            return response()->json([
                'id'    => $admin
            ]);
        }
        if(!is_null($manager)){
            return response()->json([
                'id'    => $manager
            ]);
        }
        if(!is_null($programmer)){
            return response()->json([
                'id'    => $programmer
            ]);
        }
        if(!is_null($teknisi)){
            return response()->json([
                'id'    => $teknisi
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->sendResponse([], 'User telah logout!');
    }
}
