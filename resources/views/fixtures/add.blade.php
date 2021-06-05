@extends('layouts.app')

@section('title', 'Tworzenie Terminarzy')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            @if(empty($start))
            <form method="GET" action="{{route('fixtures.add')}}">

                <div class="form-group">
                    <label for="startDate">Data pierwszej kolejki</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                </div>

                <div class="form-group">
                    <label for="startTime">godzina pierwszego meczu</label>
                    <input type="time" class="form-control" id="startTime" name="startTime" required>
                </div>

                <div class="form-group">
                    <label for="gameTime">Co ile mają odbywać się kolejne mecze(wyrazone w minutach)</label>
                    <input type="number" class="form-control" name="gameTime" id="gameTime" required>
                </div>

                <div class="form-group">
                    <label for="endTime">Godzina ostatniego meczu</label>
                    <input type="time" class="form-control" name="endTime" id="endTime" required>
                </div>

                <div class="form-group">
                    <label for="pitches">Wybierz Liczbe boisk</label>
                    <input type="number" class="form-control" id="pitches" name="pitches" required>
                </div>

                <input type="number" name="competitionID" hidden value="{{$competitionID}}">
                <button type="submit" name="generate" class="btn btn-primary">Generuj Terminarz</button>
                @csrf
            </form>
            @else

            <div class="row">
                <div class="col">

                    <form action="{{ route('fixtures.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <p>Goście</p>
                            </div>

                            <div class="col">
                                <p>Gospodarze</p>
                            </div>

                            <div class="col">
                                <p>Boisko</p>
                            </div>

                            <div class="col">
                                <p>Data</p>
                            </div>

                            <div class="col">
                                <p>Godzina</p>
                            </div>
                        </div>

                        @php
                        $date= $startDate;
                        $hour = $startTime;
                        $gameTime = $request['gameTime'];
                        $pitch=1;
                        @endphp

                        @foreach($fixtures as $team)

                        @if($hour >= $endTime && $pitch > $request['pitches'] )
                        @php
                        $date = $date->addDay(7);
                        $hour = $beginTime;
                        $pitch =1;
                        @endphp
                        @endif

                        @if($pitch > $request['pitches'])
                        @php
                        $hour->addMinutes($gameTime);
                        $pitch=1;
                        
                        @endphp
                        @endif

                        <div class="form-row">
                    
                            <div class="col">
                            <input hidden type="number" name="competitionID[]" value="{{$competitionID}}">
                                <input type="text" name="hosts[]" value="{{$team->hosts}}">
                                <input hidden type="number" name="hostsID[]" value="{{$team->hostsID}}">
                            </div>


                            <div class="col">
                                <input type="text" name="visitors[]" value="{{$team->visitors}}">
                                <input hidden type="number" name="visitorsID[]" value="{{$team->visitorsID}}">
                            </div>


                            <div class="col">
                                <input type="number" name="pitch[]" value="{{$pitch}}">
                            </div>

                            <div class="col">
                                <input type="date" name="date[]" value="{{$date->format(('Y-m-d'))}}">
                            </div>

                            <div class="col">
                                <input type="time" name="time[]" value="{{$hour->format('H:i')}}">
                                
                            </div>
                        </div>
                        @php
                        $pitch++;
                        @endphp
                        @endforeach
                     
                        <button type="submit" class="btn btn-primary">Dodaj Terminarz</button>
                        @csrf
                        @method('POST')
                    </form>
                </div>
            </div>

            @endif
        </div>
    </div>

</div>

@endsection