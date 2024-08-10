<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'summary' => 'required|min:5',
            'image' => 'mimes:png,jpg,jpeg',
            'stok' => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'=> 'Title Buku Harus Diisi',
            'summary.required' => 'Summary Buku Harus Diisi',
            'summary.min' => 'Minimal 20 karakter',
            'category_id.required' => 'Kategori Buku Harus Diisi',
            'image.mimes' => 'Gambar hanya dapat berformat : png,jpg,jpeg',
            'stok.required' => 'Stok buku harus diisi',
        ];
    }
}
