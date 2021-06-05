@extends('layouts.app')

@section('title', 'Druzyny Jomafive')

@section('content')

<div class="container-fluid">
    <h4 class="text-center">Druzyny</h4>
    <ul class="nav nav-pills nav-fill" id="pills-teams" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-senior-tab" data-toggle="pill" href="#pills-senior" role="tab" aria-controls="pills-senior" aria-selected="true">Seniorskie</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-junior-tab" data-toggle="pill" href="#pills-junior" role="tab" aria-controls="pills-junior" aria-selected="false">Juniorskie</a>
        </li>
    </ul>
</div>

<div class="container tab-content" id="pills-teams">
    <div class="tab-pane fade show" id="pills-senior">
        <div class="row flex-row flex-wrap my-3">
            @foreach($allTeams as $team)
            <div class="col-sm-12 col-md-4 col-lg-2 my-1">

                <div class="card bg-success text-white">
                    <img src='{{asset("storage/$team->shieldPath")}}' class="img-fluid mx-auto" alt="{{$team->shieldPath}}">
                    <h6 class="text-center">{{$team->name}}</h6>
                    <div class="d-flex justify-content-around">
                        <small class="">Liga: {{$team->league}}</small>
                        <small class="">Poziom: {{$team->level}}</small>
                    </div>

                    {{$team->manager->name}} {{$team->manager->surname}} {{$team->manager->phoneNumber}}
                    {{$team->manager->email}}

                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="tab-pane fade show" id="pills-junior">
        <div class="row flex-row flex-wrap my-3">
            @foreach($allJuniorTeams as $juniorTeam)
            <div class="col-sm-12 col-md-4 col-lg-2">

                <div class="card bg-success text-white">
                    <img src='{{asset("storage/$juniorTeam->shieldPath")}}' class="img-fluid mx-auto">
                    <h6 class="text-center">{{$juniorTeam->name}}</h6>
                    <div class="d-flex justify-content-around">
                        <small class="">Liga: {{$juniorTeam->class}}</small>
                        <small class="">Poziom: {{$juniorTeam->level}}</small>

                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection