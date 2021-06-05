<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{   
    public function index()
    {
        return redirect(
            route('articles.index'),
            301
        );
    }
}