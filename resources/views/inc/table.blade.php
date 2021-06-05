<ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link btn-dark btn-sm" id="pills-fixture-tab" data-toggle="pill" href="#pills-fixture" role="tab" aria-controls="pills-fixture" aria-selected="true">TERMINARZ</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link btn-dark btn-sm mx-1" id="pills-results-tab" data-toggle="pill" href="#pills-results" role="tab" aria-controls="pills-results" aria-selected="false">WYNIKI</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link btn-dark btn-sm active" id="pills-table-tab" data-toggle="pill" href="#pills-table" role="tab" aria-controls="pills-table" aria-selected="false">TABELA</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade" id="pills-fixture" style="max-height:500px;" role="tabpanel" aria-labelledby="pills-fixture-tab">
    @include('inc.fixtures')

  </div>
  <div class="tab-pane fade overflow-auto" style="max-height:500px;" id="pills-results" role="tabpanel" aria-labelledby="pills-profile-tab">
    @include('inc.latestScores')
  </div>
  <div class="tab-pane fade show active" id="pills-table" role="tabpanel" aria-labelledby="pills-table-tab">
    <table class="table table-sm table-striped table-hover caption-bottom">
      <caption>Liga {{$league ?? ''}} </caption>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Team</th>
          <th scope="col">PLD</th>
          <th scope="col">W</th>
          <th scope="col">D</th>
          <th scope="col">L</th>
          <th scope="col">PKT</th>
        </tr>
      </thead>
      <tbody>
      @php($i = 0)
        @foreach($leagueTable as $row)
        @php($i++)
        <tr>
          <th scope="row">{{$i}}</th>
          <td>{{$row->teamName}}</td>
          <td>{{$row->games}}</td>
          <td>{{$row->wins}}</td>
          <td>{{$row->draws}}</td>
          <td>{{$row->losts}}</td>
          <td>{{$row->points}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
