@extends('layouts.app')

@section('content')

<div class="container shadow-lg my-3">

    <div class="row">
        <div class="col-12">
            <h6 class="text-center">Kolejka: 1</h6>
            <h6 class="text-center">liga biznesowa</h6>

            <div class="row justify-content-between">
                <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                    <img class="img-fluid" style="max-height:100px;" src="{{asset('images/5.png')}}">
                    <h6 class="text-center">{{$game->hosts}}</h6>
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                    <h3>{{$game->hosts_goals}} : {{$game->visitors_goals}}</h3>
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                    <img class="img-fluid" style="max-height:100px;" src="{{asset('images/5.png')}}">
                    <h6 class="text-center">{{$game->visitors}}</h6>
                </div>
            </div>

        </div>
    </div>

    <!--     <div class="row">
        <div class="col-12">
            <h6 class="text-center">Kolejka: 1</h6>
            <h6 class="text-center">liga biznesowa</h6>

            <div class="row justify-content-between">
                <div class="col-4 bg-primary d-flex justify-content-center align-items-center flex-column">
                    <img class="img-fluid" style="max-height:100px;" src="{{asset('images/5.png')}}">
                    <h6 class="text-center">{{$game->hosts}}</h6>
                </div>
                <div class="col-4 bg-secondary d-flex justify-content-center align-items-center flex-column">
                    <h3>{{$game->hosts_goals}} : {{$game->visitors_goals}}</h3>
                </div>
                <div class="col-4 bg-primary d-flex justify-content-center align-items-center flex-column">
                    <img class="img-fluid" style="max-height:100px;" src="{{asset('images/5.png')}}">
                    <h6 class="text-center">{{$game->visitors}}</h6>
                </div>
            </div>

        </div>
    </div> -->

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-4">
                    <h6 class="text-center">skład {{$game->hosts}}</h6>
                    @if(count($hosts) > 0)
                    @foreach($hosts as $player)
                    <div class="text-left">
                        {{$player->name}} {{$player->surname}}
                    </div>
                    @endforeach
                    @else
                    <h6 class="text-center">Nie został jeszcze podany</h6>
                    @endif
                </div>

                <div class="col-lg-4 bg-warning d-flex justify-content-center">
                    <div class="" style="border-left: 6px solid green;height: 500px;"></div>
                    <p style="position:absolute">x</p>
                    <p class="mt-3" style="position:absolute">Y</p>
                </div>

                <div class="col-lg-4">
                    <h6 class="text-center">skład {{$game->visitors}}</h6>
                    @if(count($visitors) > 0)
                    @foreach($visitors as $player)
                    <div class="text-right">
                        {{$player->name}} {{$player->surname}}
                    </div>
                    @endforeach
                    @else
                    <h6 class="text-center">Nie został jeszcze podany</h6>
                    @endif
                </div>
            </div>

        </div>
    </div>


</div>
@endsection