<div class="col">
    <form action="{{ route('test',['id' => $competitionID]) }}" method="POST" novalidate>
        <div class="form-group">
            <label for="stage">Wybierz faze</label>
            <select class="form-control @error('stage') is-invalid @enderror" id="stage" name="stage">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="firstGameHour">godzina pierwszego meczu</label>
            <input class="form-control" type="time" name="firstGameHour" value="{{now()->format('h:i')}}">
        </div>

        <div class="form-group">
            <label for="lastGameHour">godzina ostatniego meczu</label>
            <input class="form-control" required type="time" name="lastGameHour" value="{{now()->format('h:i')}}">
        </div>

        <div class="form-group">
            <label for="gameDuration">co ile minut ma odbyc sie mecz </label>
            <input class="form-control" required type="number" name="gameDuration" value="60">
        </div>

        <div class="form-group">
            <label for="startDate">data rozpoczecia </label>
            <input class="form-control" required type="date" name="startDate" value="{{now()->format('Y-m-d')}}">
        </div>

        <div class="form-group">
            <label for="numOfPitches">Liczba Boisk</label>
            <input class="form-control" type="number" name="numOfPitches" value="1">
        </div>

        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary">Generuj Terminarz</button>
            @method('POST')
            @csrf
        </div>
    </form>
</div>

<!-- Manually changing group -->
<div class="col">
    <form action="{{ route('leagueTables.edit',['id' => $competitionID]) }}" method="POST" novalidate>
        <div class="form-group">
            <label for="stage">Wybierz Druzyne</label>
            <select class="form-control @error('team') is-invalid @enderror" id="team" name="team">
                @foreach($juniorTeams as $team)
                <option>{{$team->teamName}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="stage">Wybierz faze</label>
            <select class="form-control @error('stage') is-invalid @enderror" id="stage" name="stage">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="group">Nowa Grupa</label>
            <select class="form-control @error('group') is-invalid @enderror" id="group" name="group">
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="form-control btn btn-info">Przenieś</button>
            @method('POST')
            @csrf
        </div>
    </form>
</div>