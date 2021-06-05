extends('layouts.app')

@section('content')

<form action="{{ route('fixtures.store') }}" method="POST" enctype="multipart/form-data">
    @php
    $date=now();
    $hour=12;
    $pitch=1;
    @endphp
    @foreach($fixtures as $team)

    @if($hour > 18)
    @php
    $date = $date->addDay(7);
    $hour=12;
    $pitch++;
    @endphp
    @endif

    @if($pitch > 4)
    @php
    $pitch=1;
    @endphp
    @endif

    <div class="form-row">
        <div class="col">
            <input type="text" name="games[]" value="{{$team->hosts}}">
        </div>



        <div class="col">
            <input type="text" name="games[]" value="{{$team->visitors}}">
            <input hidden type="number" name="games[]" value="{{$competitionID}}">
        </div>

        <div class="col">
            <input type="date" name="games[]" value="">

        </div>

        <div class="col">
            <input type="number" name="games[]" value="{{$pitch}}">
        </div>

        <div class="col">
            <input type="date" name="games[]" value="{{$date->format(('Y-m-d'))}}">
        </div>

        <div class="col">
            <input type="time" name="games[]" value="{{$hour}}:00">
        </div>

    </div>
    @php
    $hour++;
    @endphp
    @endforeach


    <button type="submit" class="btn btn-primary">Dodaj Terminarz</button>
    @csrf
    @method('POST')
</form>

@endsection