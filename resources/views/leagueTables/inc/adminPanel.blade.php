<div class="row">
    <div class="col-3">
        <form action="{{ route('test',['id' => $competitionID]) }}" method="POST" novalidate>
            <select class="form-control @error('stage') is-invalid @enderror" id="stage" name="stage">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>

            godzina pierwszego meczu
            <input type="time" name="firstGameHour">
            godzina ostatniego meczu
            <input type="time" name="lastGameHour">
            co ile minut ma odbyc sie mecz
            <input type="number" name="gameDuration">
            data rozpoczecia
            <input type="date" name="startDate">
            
            <button type="submit" class="btn btn-primary">Generuj Terminarz</button>
            @method('POST')
            @csrf
        </form>
    </div>
</div>