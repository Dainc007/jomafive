@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="col-10 mx-auto">
        @include('leagueTables.inc.mainTable')
    </div>

    <div class="row mt-3">
        @include('leagueTables.inc.stageTable')
    </div>

    <div class="col">
        @include('leagueTables.inc.adminPanel')
    </div>

    <div class="col">
        @if(Auth::check())
        @include('leagueTables.inc.setScores')
        @else
        @include('leagueTables.inc.fixtures')
        @endif
    </div>

</div>

@endsection