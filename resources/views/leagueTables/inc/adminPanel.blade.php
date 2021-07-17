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