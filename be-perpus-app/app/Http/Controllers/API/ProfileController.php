<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'age' => 'required|integer',
            'bio' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $currentUser = auth()->user();

        $profileData = Profile::updateOrCreate(
            ['user_id' => $currentUser->id],
            [
                'age' => $request['age'],
                'bio' => $request['bio'],
                'user_id' => $currentUser->id
            ]
        );

        return response()->json([
            "message" => "Data profile berhasil ditambahkan",
            "data" => $profileData
            ], 201);
    }

    public function index()
    {
        $currentUser = auth()->user();
        $profile = Profile::with('user')->where('user_id', $currentUser->id)->first();

        return response()->json([
            "message" => "Tampil Data Profile",
            "data" => $profile
            ], 200);
    }
}
