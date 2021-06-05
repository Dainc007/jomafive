@extends('layouts.articles')

@section('title' , 'Ligi Biznesowe')

@section('SideBarRight')
<div class="py-3">
@include('inc.table')
@include('inc.playerStats')
</div>

@endsection

@section('content')
<h2 class="text-center py-3">AKTUALNOŚCI {{ $leagueHeader ?? '' }}</h2>
<div class="row">
    @foreach($businessArticles as $article)

    <div class="col-sm-4 shadow-lg">
        <a class="article" href="/articles/{{$article->slug}} ">
            <img class="img-fluid rounded mt-3 mx-auto d-block" src='{{asset("storage/$article->photoPath")}}' alt="{{$article->title}}" title="{{$article->title}}">
            <h5 class="text-center py-2">{{$article->title}}</h5>
            <p class="text-center mb-2">{{ Str::limit($article->content, 150)  }}</p>
        </a>
    </div>
    @endforeach
</div>

<div class="row py-3">
    <div class="col-sm">
        <h2 class="text-center">Galeria {{ $leagueHeader ?? '' }}</h2>
    </div>
</div>

<div class="row px-3">
    @foreach ($businessArticles as $photo)
    <div class="col-sm-4 py-3 shadow-lg mx-auto d-block">
        <img style="max-height:200px;" class="img-fluid rounded mx-auto d-block" src='{{asset("storage/$photo->photoPpath")}}'>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-sm">
        <h2 class="text-center">GALERIA VIDEO {{ $leagueHeader ?? '' }}</h2>
    </div>
</div>

<div class="row">
    <div class="col-sm">
        <img class="img-fluid" src="https://picsum.photos/400/200">
    </div>
    <div class="col-sm">
        <img class="img-fluid" src="https://picsum.photos/400/200">
    </div>
    <div class="col-sm">
        <img class="img-fluid" src="https://picsum.photos/400/200">
    </div>
    
</div>
@endsection
