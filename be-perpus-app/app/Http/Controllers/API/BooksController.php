<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Http\Requests\BooksRequest;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Books::all();

        $books = Books::orderBy('created_at', 'DESC')->get();

        return response()->json([
            "message" => "Tampil Data Buku Berhasil",
            "data" => $books
       ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BooksRequest $request)
    {
        $data = $request->validated();

        // jika file gambar diinput

        if ($request->hasFile('image')) {

            // membuat unique name pada gamabr yang di input

            $imageName = time().'.'.$request->image->extension();

            // simpan gambar pada file storage

            $request->image->storeAs('public/images', $imageName);

            // menganti request nilai request image menjadi $imageName yang baru bukan berdasarkan request

            $path = env('APP_URL').'/storage/images/';

            $data['image'] = $path.$imageName;

       }

        Books::create($data);

       return response()->json([
            "message" => "Data buku berhasil ditambahkan"
       ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $books = Books::with('category', 'listComments')->find($id);

        $books = Books::with('category', 'listBorrows')->find($id);

        // $books = Books::find($id);

        if(!$books){
            return response()->json([
                "message" => "Data id tidak ditemukan"
            ], 404);
        }
        
        return response()->json([
            "message" => "Data dengan id : $id",
            "data" => $books
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BooksRequest $request, string $id)
    {
        $data = $request->validated();

        $booksData = Books::find($id);

        if(!$booksData){
            return response()->json([
                "message" => "Data Buku id tidak ditemukan"
            ], 404);
        }


        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada

            if ($booksData->image) {
                $nameImage = basename($booksData->image);
                Storage::delete('public/images/' . $nameImage);
                // return response()->json($data);
            }

            $imageName = time().'.'.$request->image->extension();

            $request->image->storeAs('public/images', $imageName);

            $path = env('APP_URL').'/storage/images/';

            $data['image'] = $path.$imageName;

        }

        $booksData->update($data);

        return response()->json([
            "message" => "Data buku berhasil diupdate"
       ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booksData = Books::find($id);

        if(!$booksData){
            return response()->json([
                "message" => "Data buku id tidak ditemukan"
            ], 404);
        }

        if ($booksData->image) {
            $nameImage = basename($booksData->image);
            Storage::delete('public/images/' . $nameImage);

            // return response()->json($data);

        }

        $booksData->delete();

        return response()->json([
            "message" => "Data buku berhasil dihapus"
       ], 200);
    }
}
