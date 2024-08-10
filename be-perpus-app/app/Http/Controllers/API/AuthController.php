<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Roles;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roleUser  = Roles::where('name', 'user')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleUser->id
        ]);

        $UserData  = User::with('Role')->where('email', $request['email'])->first();

        // $user->generateOtpCode();

        $token = JWTAuth::fromUser($user);

        // Mail::to($user->email)->queue(new RegisterMail($user));

        return response()->json([
            "message" => "Register User Berhasil",
            "user" => $UserData,
            "token" => $token
        ]);
    }
    
    public function getUser()
    {
        $user = auth()->user();

        // $currentUser = User::with('Profile', 'historyComments')->find($user->id);

        $currentUser = User::with('Profile', 'Role')->find($user->id);

        // $currentUser = auth()->user();

        return response()->json([
            "message"=>"berhasil get user",
            "user" => $currentUser
        ]);
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$user = auth()->attempt($credentials)) {
            return response()->json(
                [
                    'message' => 'User Invalid'
                ], 401);
        }

        $UserData  = User::with('Role')->where('email', $request['email'])->first();

        // $UserData = User::where('email', $request['email'])->first();

        $token = JWTAuth::fromUser($UserData);

        return response()->json([
            "user" => $UserData,
            "token" => $token
        ]);

    }

    public function logout()
    {
        auth()->logout();

        return response()->json(
            [
                'message' => 'Successfully logged out'
            ]);
    }
}
