@extends('layouts.app')

@section('content')

@foreach($showPlayer as $player)
   <p> Piłkarz: {{$player->name}}  {{$player->surname}}</p>
   <p>Druzyna: {{$player->teamName}} </p>
   <p>Rocznik: {{$player->yearOfBirth}} </p>

@endforeach

@foreach($players as $player)
    <a href="/player/show/{{$player->id}}"> {{$player->name}} - {{$player->surname}} </a> 
@endforeach




@endsection