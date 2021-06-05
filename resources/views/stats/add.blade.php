@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('stats.store')}}" method="POST">
        <div class="row">
            <div class="col">
                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-hosts-tab" data-toggle="pill" href="#pills-hosts" role="tab" aria-controls="pills-profile" aria-selected="false">{{$fixture['hosts']}}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <!--  <a class="nav-link active" id="pills-game-tab" data-toggle="pill" href="#pills-game" role="tab" aria-controls="pills-home" aria-selected="true">Raport Meczowy</a> -->
                        <h6>Wynik</h6>
                        <p><input type="number" name="hosts_goals"> :
                            <input type="number" name="visitors_goals">
                        </p>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-visitors-tab" data-toggle="pill" href="#pills-visitors" role="tab" aria-controls="pills-contact" aria-selected="false">{{$fixture['visitors']}}</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">


                    <!--  <div class="tab-pane fade show active" id="pills-game" role="tabpanel" aria-labelledby="pills-game-tab">
                    <h6 class="text-center">Raport Meczowy</h6>
                </div> -->

                    <div class="tab-pane fade" id="pills-hosts" role="tabpanel" aria-labelledby="pills-hosts-tab">
                        <h5 class="text-center">{{$fixture['hosts']}}</h5>
                        <h6 class="text-center">Zaznacz uczestników</h6>

                        @foreach($hosts as $player) <div class="form-check">
                            <input class="form-check-input" name="hostsPlayers[]" type="checkbox" value="{{$player->id}}" checked>
                            <!--  <input hidden type="text" name="hostsNames[]" value="{{$player->name}}">
                        <input hidden type="text" name="hostsSurnames[]" value="{{$player->surname}}"> -->
                            <label class="form-check-label" for="">
                                {{$player->name}} {{$player->surname}}
                            </label>
                        </div>
                        @endforeach

                        <div class="row">
                            <div class="col">
                                <h6 class="text-center">Strzelcy</h6>
                            </div>
                            <div class="col">
                                <h6 class="text-center">Minuta</h6>
                            </div>
                            <div class="col">
                                <h6 class="text-center">asystent(opcjonalnie)</h6>
                            </div>
                        </div>

                        @for($i = 0; 10 >= $i; $i++)
                        <div class="row">
                            <div class="col">
                                <select name="hostsG[]" class="form-control form-select w-100" aria-label="Default select example">
                                    <option selected value="">Strzelec</option>
                                    @foreach($hosts as $player)
                                    <option value="{{$player->id}}">{{$player->surname}} {{$player->name}}.</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <input class="form-control" type="number" name="minutes[]">
                            </div>

                            <div class="col">
                                <select name="hostsA[]" class="form-control form-select w-100" aria-label="Default select example">
                                    <option value="" selected>Asystent</option>
                                    @foreach($hosts as $player)
                                    <option value="{{$player->id}}">{{$player->surname}} {{$player->name}}.</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endfor

                    </div>


                    <div class="tab-pane fade" id="pills-visitors" role="tabpanel" aria-labelledby="pills-visitors-tab">
                        <h6 class="text-center">{{$fixture['visitors']}}</h6>

                        @foreach($visitors as $player) <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="visitorsPlayers[]" value="{{$player->id}}" checked>
                            <label class="form-check-label" for="">
                                {{$player->name}} {{$player->surname}}
                            </label>
                        </div>
                        @endforeach

                        <div class="row">
                            <div class="col">
                                <h6 class="text-center">Strzelcy</h6>
                            </div>
                            <div class="col">
                                <h6 class="text-center">Minuta</h6>
                            </div>
                            <div class="col">
                                <h6 class="text-center">asystent(opcjonalnie)</h6>
                            </div>
                        </div>

                        @for($i = 0; 10 >= $i; $i++)
                        <div class="row">
                            <div class="col">
                                <select name="visitorsG[]" class="form-control form-select" aria-label="Default select example">
                                    <option value="" selected>Strzelec</option>
                                    @foreach($visitors as $player)
                                    <option value="{{$player->id}}">{{$player->surname}} {{$player->name}}.</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <input class="form-control form-control"type="number">
                            </div>

                            <div class="col">
                                <select name="visitorsA[]" class="form-control form-select" aria-label="Default select example">
                                    <option value="" selected>Asystent</option>
                                    @foreach($visitors as $player)
                                    <option value="{{$player->id}}">{{$player->surname}} {{$player->name}}.</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endfor

                        <div class="row">
                            <div class="col">
                                <input hidden type="number" name="gameID" value="{{$fixture['id']}}">
                                <input hidden type="number" name="hostsID" value="{{$fixture['hostsID']}}">
                                <input hidden type="number" name="visitorsID" value="{{$fixture['visitorsID']}}">
                                <input hidden type="text" name="hosts" value="{{$fixture['hosts']}}">
                                <input hidden type="text" name="visitors" value="{{$fixture['visitors']}}">
                                <input hidden type="number" name="competitionID" value="{{$fixture['competitionID']}}">
                                <input type="submit">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @csrf
    </form>
</div>

@endsection