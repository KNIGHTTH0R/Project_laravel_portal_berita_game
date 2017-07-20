<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeritaRequest extends StoreBeritaRequest
{
 
    public function rules()
    {
    
        
            $rules= parent::rules();
            $rules['judul']='required|unique:beritas,judul,'. $this->route('berita');
            return $rules;
        
    }
}
