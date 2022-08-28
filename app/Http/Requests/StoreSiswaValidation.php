<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSiswaValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nis' => 'required|unique:siswa,nis|min:6',
            'nama_siswa' => 'required|string|min:3',
            // 'alternatif' => 'required',
            'no_telp' => 'required|min:11',
            'alamat' => 'required|string|min:5',
            'tahun_masuk' => 'required',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required'
        ];
    }
}
