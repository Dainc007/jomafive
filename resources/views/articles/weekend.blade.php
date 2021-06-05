@extends('layouts.articles')

@section('title' , 'Ligi Weekendowe')

@section('SideBarRight')
@include('inc.table')

@include('inc.table')
@endsection

@section('content')
<h2 class="text-center">Aktualności {{ $leagueHeader ?? '' }}</h2>
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

<div class="row">
    <div class="col-sm">
        <h2 class="text-center">Galeria Video {{ $leagueHeader ?? '' }}</h2>
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

<div class="row">
    <div class="col-sm">
        <h2 class="text-center">Galeria {{ $leagueHeader ?? '' }}</h2>
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
@section('banners')
<div class="row">
    <div class="col-sm-12 col-lg-8">
        <img class="img-fluid d-block mx-auto" src="{{ asset('images/banner.png') }}" style="max-height:35vh;">
    </div>

    <div class="col-sm-12 col-lg-4">
        <img class="img-fluid d-block mx-auto" src="{{ asset('images/banner.png') }}" style="max-height:35vh;">
    </div>

</div>
@endsection
@section('news')




<div class="row">

    @foreach($weekendArticles as $article)

    <div class="col-sm">
        <img class="img-fluid" src="https://picsum.photos/400/200" title="{{$article->title}}">
        <p>{{ $article->league }}</p>
    </div>

    @endforeach

    @endsection