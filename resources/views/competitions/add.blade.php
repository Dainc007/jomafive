@extends('layouts.app')

@section('title' , 'Rozgrywki - Tworzenie')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            @if(isset($teams))
            <form method="POST" action="{{route('competitions.store', ['request']) }}" enctype="multipart/form-data">
                <div class="col form-group">
                    <label for="pickedTeams">Grupa A</label>
                    <select multiple class="form-control @error('pickedTeams') is-invalid @enderror" id="pickedTeams" name="pickedTeams[1][]">
                        @foreach($teams as $team)
                        <option>{{$team->name}}</option>
                        @endforeach
                    </select>

                    <label for="pickedTeams">Grupa B</label>
                    <select multiple class="form-control @error('pickedTeams') is-invalid @enderror" id="pickedTeams" name="pickedTeams[2][]">
                        @foreach($teams as $team)
                        <option>{{$team->name}}</option>
                        @endforeach
                    </select>

                    <label for="pickedTeams">Grupa C</label>
                    <select multiple class="form-control @error('pickedTeams') is-invalid @enderror" id="pickedTeams" name="pickedTeams[3][]">
                        @foreach($teams as $team)
                        <option>{{$team->name}}</option>
                        @endforeach
                    </select>

                    <input type="text" hidden name="league" value="{{$request->league}}">
                    <input type="number" hidden name="level" value="{{$request->level}}">
                    <input type="number" hidden name="class" value="{{$request->class}}">

                    @error('level')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Stworz rozgrywki</button>
                @method('POST')
                @csrf
            </form>

            @else
            <h5>Dorośli</h5>
            <form method="GET" action="{{route('competitions.add')}}">
                <div class="form-row">
                    <div class="col form-group">
                        <label for="league">Wybierz rodzaj ligi 1</label>
                        <select class="form-control @error('league') is-invalid @enderror" id="league" name="league">
                            <option>business</option>
                            <option>weekend</option>
                        </select>
                        @error('league')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col form-group">
                        <label for="league">Wybierz poziom ligowy</label>
                        <select class="form-control @error('level') is-invalid @enderror" id="level" name="level">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                        <small id="levelHelp" class="form-text text-muted">1 Oznacza Najwyzsza klasę rozgrywkowa</small>
                        @error('level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" name="showSeniorTeams" class="btn btn-primary">Pokaz druzyny</button>
                @method('GET')
                @csrf
            </form>

            <h5> Juniorzy</h5>
            <form method="GET" action="{{route('competitions.add')}}">
                <div class="form-row">
                    <div class="col form-group">
                        <label for="league">Wybierz Rocznik</label>
                        <select class="form-control @error('league') is-invalid @enderror" id="class" name="class">
                            <option>2010</option>
                            <option>2009</option>
                        </select>
                        @error('league')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" name="showJuniorTeams" class="btn btn-primary">Pokaz druzyny</button>
                @method('GET')
                @csrf
            </form>
            @endif
        </div>
    </div>
</div>
@endsection