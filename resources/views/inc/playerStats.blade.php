<ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-goals-tab" data-toggle="pill" href="#pills-goals" role="tab" aria-controls="pills-goals" aria-selected="true">BRAMKI</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-assits-tab" data-toggle="pill" href="#pills-assists" role="tab" aria-controls="pills-assists" aria-selected="false">ASYSTY</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-canadian-tab" data-toggle="pill" href="#pills-canadian" role="tab" aria-controls="pills-canadian" aria-selected="false">KANADYJSKA</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-goals" role="tabpanel" aria-labelledby="pills-goals-tab">
        @if((count($scorers) > 0))
        <table class="table table-striped table-hover caption-bottom">
            <caption>Liga {{$league ?? ''}} </caption>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Player</th>
                    <th scope="col">Team</th>
                    <th scope="col">Scored</th>
                </tr>
            </thead>
            <tbody>

                @foreach($scorers as $row)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$row->name}} {{$row->surname}}</td>
                    <td>{{$row->teamName}}</td>
                    <td>{{$row->goals}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <span>Żaden zawodnik nie wpisał się jeszcze na listę strzelców</span>
        @endif

    </div>
    <div class="tab-pane fade" id="pills-assists" role="tabpanel" aria-labelledby="pills-assists-tab">
    @if(count($assistants) > 0)
        <table class="table table-striped table-hover caption-bottom">
            <caption>Liga {{$league ?? ''}} </caption>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Player</th>
                    <th scope="col">Team</th>
                    <th scope="col">Assists</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assistants as $row)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$row->name}} {{$row->surname}}</td>
                    <td>{{$row->teamName}}</td>
                    <td>{{$row->assists}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <span>Żaden zawodnik nie wpisał się jeszcze na listę asystentów</span>
        @endif
    </div>
    <div class="tab-pane fade" id="pills-canadian" role="tabpanel" aria-labelledby="pills-canadian-tab">
    @if(count($canadian) > 0)
        <table class="table table-striped table-hover caption-bottom">
            <caption>Liga {{$league ?? ''}} </caption>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Player</th>
                    <th scope="col">Team</th>
                    <th scope="col">Kanadyjska</th>
                    <th scope="col">bramki</th>
                    <th scope="col">asysty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($canadian as $row)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$row->name}} {{$row->surname}}</td>
                    <td>{{$row->teamName}}</td>
                    <td>{{$row->canadian}}</td>
                    <td>{{$row->goals}}</td>
                    <td>{{$row->assists}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <span>Żaden zawodnik nie wpisał się jeszcze na listę punktacji kanadyjskiej</span>
        @endif
    </div>
</div>