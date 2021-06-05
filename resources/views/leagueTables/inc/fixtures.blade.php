@if(count($junior_games) > 0)
@foreach($junior_games as $game)
<a target="_blank" href="{{route('fixtures.gameShow', [
                'gameID' => $game->id,
                'competitionID' => $game->competitionID
            ])}}"></a>

<div class="col-12 d-flex flex-row overflow-auto row justify-content-between shadow-sm pt-2">
    <div class="col-4">
        <img class="img-fluid d-block mx-auto" style="max-height:50px;" src='{{asset("storage/images/gallery/shields/$game->hosts.png")}}'>
        <h6 class="text-center">{{$game->hosts}}</h6>
    </div>
    <div class="col-4">
        <h4 class="text-center">{{$game->hour}}</h4>
        <h6 class="text-center">{{$game->date}}</h6>
    </div>
    <div class="col-4">
        <img class="img-fluid d-block mx-auto" style="max-height:50px;" src='{{asset("storage/images/gallery/shields/$game->hosts.png")}}'>
        <h6 class="text-center">{{$game->visitors}}</h6>
    </div>
</div>
@endforeach
@else
<p> Dla tych rozgrywek nie został jeszcze wygenerowany terminarz.</p>
@endif