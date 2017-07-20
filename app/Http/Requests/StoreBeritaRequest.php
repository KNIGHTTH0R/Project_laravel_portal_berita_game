<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use illuminate\Support\Facades\Auth;

class StoreBeritaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'judul' =>'required|unique:beritas,judul',
            'categori_id' => 'required|exists:categoris,id',
            'deskripsi' => 'string',
            'cover' => 'image|max:2048'
        ];
    }

}
