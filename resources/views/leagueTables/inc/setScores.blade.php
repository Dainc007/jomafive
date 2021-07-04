@if(count($junior_games) > 0)
<form action="{{ route('form') }}" method="POST" novalidate>
@foreach($junior_games as $game)
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="hosts">{{$game->hosts}}</label>
            <input type="hidden" name="game[]" value="{{$game->id}}">
            <input type="number" class="form-control" id="hosts" name="game[]">
        </div>
        <div class="form-group col-md-6">
            <label for="visitors">{{$game->visitors}}</label>
            <input type="number" class="form-control" id="visitors" name="game[]">
        </div>
    </div>
@endforeach
<input type="submit">
@csrf
@method('POST')
</form>
@else
<p> Dla tych rozgrywek nie został jeszcze wygenerowany terminarz.</p>
@endif