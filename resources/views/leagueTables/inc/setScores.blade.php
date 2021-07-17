@if(count($junior_games) > 0)
<form action="{{ route('form') }}" method="POST" novalidate>
    @foreach($junior_games as $game)
    <div class="form-row">

        <input type="hidden" name="game[]" value="{{$game->id}}">

        <div class="form-group col">
            <label for="hosts">{{$game->hosts}}</label>
        </div>

        <div class="form-group col">
            <input type="number" class="form-control" id="hosts" name="game[]">
        </div>

        <div class="form-group col">
            <input type="number" class="form-control" id="visitors" name="game[]">
        </div>

        <div class="form-group col">
            <label for="visitors">{{$game->visitors}}</label>
        </div>

    </div>
    @endforeach
    <div class="form-group col">
        <input class="btn btn-danger" type="submit" value="Potwierdź wyniki">
    </div>
    @csrf
    @method('POST')
</form>
@else
<p> Dla tych rozgrywek nie został jeszcze wygenerowany terminarz.</p>
@endif