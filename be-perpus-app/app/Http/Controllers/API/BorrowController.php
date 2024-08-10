<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BorrowController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'load_date' => 'required|date',
            'borrow_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $currentUser = auth()->user();

        $borrow = Borrow::updateOrCreate(
            ['user_id' => $currentUser->id],
            [
                'book_id' => $request['book_id'],
                'load_date' => $request['load_date'],
                'borrow_date' => $request['borrow_date'],
                'user_id' => $currentUser->id
            ]
        );

        $book = Books::findOrFail($request->book_id)->only('stok');

        $bookStok = $book['stok'] - 1;

        $book = Books::findOrFail($request->book_id);
        $book->stok = $bookStok;

        $book->save();

        return response()->json([
            "message" => "Data Peminjaman berhasil ditambahkan",
            "data" => $borrow
            ], 201);
    }

    public function index()
    {
        $borrows = Borrow::with('user', 'books')->get();

        return response()->json([
            "message" => "Tampil semua peminjaman Berhasil",
            "data" => $borrows
       ], 200);
    }

    public function delete(Request $request, string $id)
    {
        $borrows = Borrow::with('user', 'books')->find($id);
        
        if(!$borrows){
            return response()->json([
                "message" => "Data id tidak ditemukan"
            ], 404);
        }

        // $book = Borrow::with('books')->find($id)->only('title');

        $book_id = Borrow::with('books')->find($id)->only('book_id');

        $book = Books::find($book_id)->first();

        $bookStok = $book['stok'] + 1;

        $book = Books::find($book_id)->first();
        $book->stok = $bookStok;

        $book->save();

        $borrows->delete();


        return response()->json([
            "message" => "Data dengan id : $id berhasil terhapus"
        ]);
    }
}
