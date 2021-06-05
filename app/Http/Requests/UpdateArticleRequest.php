<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Article;

class UpdateArticleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'   => 'required|string|min:3,max:100',
            'content' => 'required|string|min:3,max:1000',
            'league'  => [
                'required',
                Rule::in(
                    Article::getAvailableLeagues()
                )
            ]
        ];
    }
}
