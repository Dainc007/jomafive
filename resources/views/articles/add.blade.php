@extends('layouts.app')

@section('title' , 'Dodawanie Artykułu')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12 py-5">
            <p> <a href="{{ route('articles.index') }}">&larr;Powrtót do Strony Głównej</a></p>

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Tytuł</label>
                    <input  type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="przykładowy tytuł..." value="{{old('title')}}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="content">Zawartłoś Artykułu</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6" value=" {{old('content') }} "></textarea>
                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="league">Wybierz rodzaj ligi</label>
                    <select class="form-control @error('league') is-invalid @enderror" id="league" name="league">
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

                <div class="form-group mb-1 mt-1 py-1">
                    <label for="inputGroupFile04">Wybierz zdjęcie artykułu</label>
                    <input type="file" required class="form-control" name="photo" id="photo" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>


                <div class="mb-3">
                    <label for="galleryName" class="form-label"> Nazwa Galerii</label>
                    <input  type="text" class="form-control @error('galleryName') is-invalid @enderror" name="galleryName" id="galleryName" placeholder="przykładowy tytuł..." value="{{old('galleryName')}}">
                    @error('galleryName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-1 mt-1 py-1">
                    <label for="gallery">Dodaj Galerię</label>
                    <input type="file"  multiple class="form-control" name="photos[]" id="photos" aria-describedby="photos" aria-label="Upload">
                </div>    

                <button type="submit" class="btn btn-primary">Dodaj Artykuł</button>
                @csrf
                @method('POST')
            </form>
        </div>
    </div>
</div>
@endsection