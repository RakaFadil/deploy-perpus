<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            "message" => 'tampil semua Kategori Buku',
            "data" => $categories,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        Category::create($request->all());

        return response()->json([
            "message" => "Berhasil Menambah Kategori"
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with("listBooks")->find($id);

        // $category = Category::find($id);

        if(!$category){
            return response()->json([
                "message" => "Data id tidak ditemukan"
            ], 404);
        }
        
        return response()->json([
            "message" => "Data dengan id : $id",
            "data" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoriesRequest $request, string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                "message" => "Data kategori id tidak ditemukan"
            ], 404);
        }

        $category->name = $request['name'];

        $category->save();

        return response()->json([
            "message" => "Berhasil Update Data dengan id : $id"
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        
        if(!$category){
            return response()->json([
                "message" => "Data id tidak ditemukan"
            ], 404);
        }

        $category->delete();

        return response()->json([
            "message" => "Data dengan id : $id berhasil terhapus"
        ]);
    }
}
