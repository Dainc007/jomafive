@extends('layouts.app')

@section('title' , 'Edycja Artykułu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 py-5">
            <p> <a href="{{ route('articles.index') }}">&larr;Powrtót do Strony Głównej</a></p>
            <p> <a href="{{ route('articles.show', ['article' => $article] ) }}">&larr;Powrtót do artykułu {{$article->title}}</a></p>

            <form action="{{ route('articles.update' , ['article' => $article] ) }}" method="POST" novalidate>
            
                <div class="mb-3">
                    <label for="title" class="form-label">Tytuł</label>
                    <input  type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="przykładowy tytuł..." value="{{old('title', $article->title)}}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="content">Zawartłośc Artykułu</label>
                    <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" value="{{old('content', $article->content)}} "></input>
                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="league">Wybierz rodzaj ligi</label>
                    <select class="form-control @error('league') is-invalid @enderror" id="league" name="league" value="{{old('league', $article->league)}}">
                        <option>business</option>
                        <option>weekend</option>
                        <option>kid</option>
                    </select>
                    @error('league')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Edytuj Artykuł</button>
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
        </div>
    </div>
</div>
@endsection