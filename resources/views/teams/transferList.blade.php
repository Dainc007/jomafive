@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row pt-2">
        <div class="col">
            <h3 class="text-center"> Lista Transferowa </h3>
            @if(isset($v))
                {{$v}}
            @endif
        </div>
    </div>

    <div class="row mt-3">

        <div class="col-lg-8 col-sm-12">


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($confirmedPlayers as $player)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{$player->name}}</td>
                        <td>{{$player->surname}}</td>
                        <td>{{$player->yearOfBirth}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="col-lg-4 col-sm">

            <div class="card text-white text-center bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header ">Zagraj w Jomafive!</div>
                <div class="card-body">
                    <h5 class="card-title">Zapisz się na listę transferową</h5>
                    <p class="card-text">Nie masz druzyny? Zostaw swoje dane, a administrator rozgrywek pomoze Ci znaleźć zespół</p>
                </div>
                <form method="POST" action="{{route('player.transferList') }}">
                    <div class="mb-3 px-3">
                        <label for="name" class="form-label">Imię</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>

                    <div class="mb-3 px-3">
                        <label for="surname" class="form-label">Nazwisko</label>
                        <input type="text" class="form-control" name="surname" id="surname">
                    </div>

                    <div class="mb-3 px-3">
                        <label for="yearOfBirth" class="form-label">Rok Urodzenia</label>
                        <input type="number" class="form-control" name="yearOfBirth" id="yearOfBirth">
                    </div>

                    <input type="text" hidden name="teamName" id="teamName" value="transferList">

                    <button type="submit" class="btn mb-2 btn-primary">Wpisz się na listę transferową</button>
                    @csrf
                </form>


            </div>
        </div>

        <div class="row">
            <div class="col">
                @if(!empty($notConfirmedPlayers))

                @foreach($notConfirmedPlayers as $player)

                <form method="POST" action="{{route('player.transferList') }}">
                    <div class="mb-3 px-3">
                     <button class="btn btn-primary"disabled> {{$player->name}} {{$player->surname}} , {{$player->yearOfBirth}} </button>
                     <input type="number" name="id" value="{{$player->id}}" hidden>
                    <button type="submit" name="accept" class="btn btn-success">akceptuj</button>
                    <button type="submit" name="reject" class="btn btn-danger">Odrzuć</button>
                    </div>
                    @csrf
                </form>
                
                @endforeach

                @endif
            </div>
        </div>


    </div>


    @endsection