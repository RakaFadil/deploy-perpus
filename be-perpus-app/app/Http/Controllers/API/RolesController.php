<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::all();

        return response()->json([
            "message" => 'Tampil data berhasil',
            "data" => $roles,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roles = Roles::create(
            [
                'name' => $request->name
            ]
        );

        return response()->json([
            "message" => "Data Roles berhasil ditambahkan",
            "data" => $roles
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roles = Roles::find($id);

        if(!$roles){
            return response()->json([
                "message" => "Data id tidak ditemukan"
            ], 404);
        }
        
        return response()->json([
            "message" => "Data dengan id : $id",
            "data" => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roles = Roles::find($id);

        if(!$roles){
            return response()->json([
                "message" => "Data id tidak ditemukan"
            ], 404);
        }

        $roles->name = $request['name'];

        $roles->save();

        return response()->json([
            "message" => "Update Role berhasil"
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roles = Roles::find($id);

        if(!$roles){
            return response()->json([
                "message" => "Data id tidak ditemukan"
            ], 404);
        }

        $roles->delete();

        return response()->json([
            "message" => "Berhasil Menghapus Role"
        ]);
    }
}
