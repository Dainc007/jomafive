@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Zespół</th>
                        <th scope="col">PLD</th>
                        <th scope="col">W</th>
                        <th scope="col">D</th>
                        <th scope="col">L</th>
                        <th scope="col">PKT</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=0; $i++
                    @endphp
                    @if(!empty($teams))
                    @foreach ($teams as $team)
                    <tr>
                        <th scope="row"> {{$i}} </th>
                        <td>{{$team->teamName}}</td>
                        <td>{{$team->games}}</td>
                        <td>{{$team->wins}}</td>
                        <td>{{$team->draws}}</td>
                        <td>{{$team->losts}}</td>
                        <td>{{$team->points}}</td>
                    </tr>
                    @php
                    $i++
                    @endphp
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>




    @if(count($games) > 0)
    @foreach($games as $game)
    <a target="_blank" href="{{route('fixtures.gameShow', [
                'gameID' => $game->id,
                'competitionID' => $game->competitionID
            ])}}"></a>

    {{$game->hosts}}
    {{$game->hour}}
    {{$game->date}}
    {{$game->visitors}}
    @endforeach
    @else
    <p> Dla tych rozgrywek nie został jeszcze wygenerowany terminarz.</p>
    <p> Uzyj generatora terminarza lub wprowadź dane z pliku xlsx</p>
    <div class="row">
        <div class="col-12">
            <form action="{{route('fixtures.add')}}" method="GET">
                <input type="number" name="competitionID" hidden value="{{$competitionID}}">
                <button type="submit" name="test" value="test" class="btn btn-primary">Automatyczne Generowanie Terminarza</button>
            </form>
        </div>
        <div class="col-12 pt-3">
            <form method="POST" action="{{ url('/import_excel/import') }}" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="file" class="form-control" name="select_file">
                </div>
                <button type="submit" class="btn btn-success">Generowanie Terminarza z Pliku</button>
                @csrf
            </form>
        </div>
    </div>

    @endif

</div>

@endsection