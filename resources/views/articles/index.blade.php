@extends('layouts.articles')

@section('title' , 'JOMAFIVE')

@section('content')
@include('inc.slideshow')
@endsection

@section('SideBarRight')

@if(session()->has('status') )
<div class="alert alert-warning" role="alert">
    {{session('status')['message']}}
</div>
@endif

<div class="">
    <div class="row py-3 mb-2 justify-content-center d-flex">
        <a class="btn btn-lg btn-dark w-100" href="{{ route('articles.business', ['level' => 1])}}">LIGA BIZNESOWA</a>
    </div>

    <div class="row mb-5 justify-content-around">
        <a class="btn btn-success" href="{{ route('articles.business', ['level' => 1])}}">LIGA 1</a>
        <a class="btn btn-success" href="{{ route('articles.business', ['level' => 2]) }}">LIGA 2</a>
        <a class="btn btn-success" href="{{ route('articles.business', ['level' => 3]) }}">LIGA 3</a>
    </div>


    <div class="row py-3 mb-2 justify-content-center">
        <a class="btn btn-lg btn-dark w-100" href="{{ route('articles.weekend', ['level' => 1]) }}">LIGA WEEKENDOWA</a>
    </div>

    <div class="row mb-5 justify-content-around">
        <a href="{{ route('articles.weekend', ['level' => 1]) }}" class="btn-success btn">LIGA 1</a>
        <a href="{{ route('articles.weekend', ['level' => 2]) }}" class="btn-success btn">LIGA 2</a>
        <a href="{{ route('articles.weekend', ['level' => 3]) }}" class="btn-success btn">LIGA 3</a>
    </div>

    <div class="row py-3 mb-2 justify-content-center">
        <a class="btn btn-lg btn-dark w-100" href="{{ route('articles.kid', ['class' => '2010']) }}">LIGA DZIĘCIĘCA</a>
    </div>

    <div class="row mb-5 justify-content-between">
        <a href="{{ route('articles.kid', ['class' => '2010']) }}" class="btn-success btn">2009/2010</a>
        <a href="{{ route('articles.kid', ['class' => 2]) }}" class="btn-success btn">2011</a>
        <a href="{{ route('articles.kid', ['class' => 3]) }}" class="btn-success btn">2012/2013</a>
        <a href="{{ route('articles.kid', ['class' => 3]) }}" class="btn-success btn">2014/2015</a>
    </div>

</div>


@endsection


@section('news')
<div class="row py-3">
    <h2 class="col-sm-12 text-center">AKTUALNOŚCI {{ $leagueHeader ?? '' }}</h2>
</div>


<div class="row">
    @foreach ($allArticles as $article)
    <div class="col-sm-3 shadow-lg">
        <a class="article" href="/articles/{{$article->slug}} ">
            <img style="max-height:200px;" class="img-fluid rounded mt-3 mx-auto d-block" src='{{asset("storage/$article->photoPath")}}' alt="{{$article->title}}" title="{{$article->title}}">
            <h5 class="text-center py-2">{{$article->title}}</h5>
            <p class="text-center mb-2">{{ Str::limit($article->content, 150)  }}</p>
        </a>
    </div>
    @endforeach
</div>

@endsection

@section('partners')
<div class="row py-3">
    <h2 class="col-sm-12 text-center">PARTNERZY</h2>
</div>

<div class="row">

    <div class="col-sm-6">
        <img class="img-fluid py-3 rounded mx-auto d-block" src="{{asset('images/pzpn_banner.png')}}" alt="{{asset('images/pzpn_banner.png')}}" title="{{$article->title}}">
    </div>

    <div class="col-sm-6">
        <img class="img-fluid py-3 rounded mx-auto d-block" src="{{asset('images/pzpn_banner.png')}}" alt="{{asset('images/pzpn_banner.png')}}" title="{{$article->title}}">
    </div>
</div>


<div class="row py-3">
    <h2 class="col-sm-12 text-center">GALERIA</h2>
</div>

<div class="row px-3">
    @foreach ($photos as $photo)
    <div class="col-sm-3 py-3 shadow-lg">
        <img style="max-height:200px;" class="img-fluid rounded mx-auto d-block" src='{{asset("storage/$photo->path")}}'>
    </div>
    @endforeach
</div>

@endsection