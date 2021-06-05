@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        <h4 class="text-center">Statystyki do wpisania</h4>
            <div class="d-flex flex-row flex-wrap">
                @foreach($games as $game)
                <a href="add/{{$game->id}}">
                <div class="card text-white bg-secondary mx-2 my-2 p-1" style="max-width: 10rem; height: 8rem; overflow:scroll">
                        <span>{{$game->hosts}} vs {{$game->visitors}}</span>
                        <span>Rozgrywki nr: {{$game->competitionID}}</span>
                        <span>{{$game->date}}</span>
                </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection