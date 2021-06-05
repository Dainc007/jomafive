@extends('layouts.app')

@section('title', 'Wszystkie Rozgrywki')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="text-center">Seniorzy</h5>
        </div>


        @foreach($competitions as $competition)
        <div class="col-lg-3">
            <p><a href="/competitions/show/{{$competition->id}}"> {{$competition->id}} </a></p>
        </div>

        @endforeach

    </div>

    <div class="row">
        <div class="col-lg-12">
            <h5 class="text-center">Juniorskie</h5>
        </div>


        @foreach($junior_competitions as $competition)
        <div class="col-lg-3">
            <p><a href="/competitions/junior/show/{{$competition->id}}"> {{$competition->id}} </a></p>
        </div>
        @endforeach

    </div>

</div>





@endsection