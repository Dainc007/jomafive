<h6 class="text-center">Faza 1</h6>
<div class="row">
    <div class="col col-sm col-md">
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
                @foreach ($stage1->where('group', 1) as $team)
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

    <div class="col col-sm col-md">
        <table class="table table-sm table-primary table-hover">
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
                @foreach ($stage1->where('group', 2) as $team)
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

    <div class="col col-sm col-md">
        <table class="table table-sm table-primary table-hover">
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
                @foreach ($stage1->where('group', 3) as $team)
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
</div>


<!-- Trzeba to poprawic -->

<h6 class="text-center">Faza 2</h6>
<div class="row">
    <div class="col col-sm col-md">
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
                @foreach ($stage2->where('group', 1) as $team)
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

    <div class="col col-sm col-md">
        <table class="table table-sm table-primary table-hover">
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
                @foreach ($stage2->where('group', 2) as $team)
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

    <div class="col col-sm col-md">
        <table class="table table-sm table-primary table-hover">
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
                @foreach ($stage2->where('group', 3) as $team)
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
</div>


<!-- Koniecznie -->

    <h6 class="text-center">Faza 3</h6>
    <div class="row">
        <div class="col col-sm col-md">
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
                    @foreach ($stage3->where('group', 1) as $team)
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

        <div class="col col-sm col-md">
            <table class="table table-sm table-primary table-hover">
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
                    @foreach ($stage3->where('group', 2) as $team)
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

        <div class="col col-sm col-md">
            <table class="table table-sm table-primary table-hover">
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
                    @foreach ($stage3->where('group', 3) as $team)
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
    </div>
