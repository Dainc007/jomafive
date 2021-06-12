  <div class="col-4 ">
      <table class="table table-sm table-primary table-hover">
          <thead>
              <caption>Grupa A</caption>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Zespół</th>
                  <th scope="col">PLD</th>
                  <th scope="col">W</th>
                  <th scope="col">D</th>
                  <th scope="col">L</th>
                  <th scope="col">PKT</th>
              </tr>
          </thead>
          <tbody>
              @php
              $i=0; $i++
              @endphp
              @if(!empty($juniorTeams) > 0)
              @foreach ($stage1 as $group => $team)
              <tr>
                  <th scope="row"> {{$i}} </th>
                  <td>{{$team->teamName}}</td>
                  <td>{{$team->games}}</td>
                  <td>{{$team->wins}}</td>
                  <td>{{$team->draws}}</td>
                  <td>{{$team->losts}}</td>
                  <td>{{$team->points}}</td>
              </tr>
              @php
              $i++
              @endphp
              @endforeach
              @endif

          </tbody>
      </table>
  </div>

  <div class="col-4">
      <table class="table table-warning table-sm table-hover">
          <thead>
              <caption>Grupa B</caption>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Zespół</th>
                  <th scope="col">PLD</th>
                  <th scope="col">W</th>
                  <th scope="col">D</th>
                  <th scope="col">L</th>
                  <th scope="col">PKT</th>
              </tr>
          </thead>
          <tbody>
              @php
              $i=0; $i++
              @endphp
              @if(!empty($juniorTeams) > 0)
              @foreach ($stage2 as $team)
              <tr>
                  <th scope="row"> {{$i}} </th>
                  <td>{{$team->teamName}}</td>
                  <td>{{$team->games}}</td>
                  <td>{{$team->wins}}</td>
                  <td>{{$team->draws}}</td>
                  <td>{{$team->losts}}</td>
                  <td>{{$team->points}}</td>
              </tr>
              @php
              $i++
              @endphp
              @endforeach
              @endif

          </tbody>
      </table>
  </div>

  <div class="col-4">

      <table class="table table-success table-sm table-hover">
          <thead>
              <caption>Grupa C</caption>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Zespół</th>
                  <th scope="col">PLD</th>
                  <th scope="col">W</th>
                  <th scope="col">D</th>
                  <th scope="col">L</th>
                  <th scope="col">PKT</th>
              </tr>
          </thead>
          <tbody>
              @php
              $i=0; $i++
              @endphp
              @if(!empty($juniorTeams) > 0)
              @foreach ($stage3 as $team)
              <tr>
                  <th scope="row"> {{$i}} </th>
                  <td>{{$team->teamName}}</td>
                  <td>{{$team->games}}</td>
                  <td>{{$team->wins}}</td>
                  <td>{{$team->draws}}</td>
                  <td>{{$team->losts}}</td>
                  <td>{{$team->points}}</td>
              </tr>
              @php
              $i++
              @endphp
              @endforeach
              @endif

          </tbody>
      </table>
  </div>