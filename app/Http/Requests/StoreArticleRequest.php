<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'title'       => 'required|string|min:3,max:100',
            'content'     => 'required|string|min:3,max:1000',
            'photoName'   => 'string|min:1,max:100',
            'photoPath'   => 'string',
            'league'      => [
                'required',
                Rule::in(
                    Article::getAvailableLeagues()
                    )
            ]
        ];
    }
}
