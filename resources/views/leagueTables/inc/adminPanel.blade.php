<!-- <div class="row">
    <div class="col-3">
        <form action="{{ route('teams.update', ['id' => $competitionID]) }}" method="POST" novalidate>
            <div class="form-group">
                <select class="form-control @error('league') is-invalid @enderror" id="team" name="team">
                    @foreach($juniorTeams as $team)
                    <option value="{{$team->teamId}}">{{$team->teamName}}</option>
                    @endforeach
                </select>
                <select class="form-control @error('league') is-invalid @enderror" id="level" name="level">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <label for="stage">Faza</label>
                <select class="form-control" id="stage" name="stage">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Zmień poziom</button>
            @method('PUT')
            @csrf
        </form>
    </div>

    <div class="col-3">
        <form method="POST" action="{{ url('/import_excel/import' , ['competitionID' => $competitionID]) }}" enctype="multipart/form-data">
            <div class="form-group">
                <input required type="file" class="form-control" name="select_file">
            </div>
            <div class="form-group">
                <label for="stage">Faza</label>
                <select class="form-control" id="stage" name="stage">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Generowanie Terminarza z Pliku</button>
            </div>
            @csrf
        </form>
    </div>
</div> -->
{{$juniorTeams}}
<div class="row">
    <div class="col-3">
        <form action="{{ route('test',['id' => $competitionID]) }}" method="POST" novalidate>
            <select class="form-control @error('phase') is-invalid @enderror" id="phase" name="phase">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
            <input type="hidden" name="teams" value="{{$juniorTeams}}">
            <button type="submit" class="btn btn-primary">Generuj Terminarz</button>
            @method('POST')
            @csrf
        </form>
    </div>
</div>