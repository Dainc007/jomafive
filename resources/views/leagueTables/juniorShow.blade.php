@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="col-10 mx-auto">
        @include('leagueTables.inc.mainTable')
    </div>

    <div class="col mt-3">
        @include('leagueTables.inc.stageTable')
    </div>

    <div class="col mt-3">
        @if(Auth::check())
        @include('leagueTables.inc.setScores')
        @else
        @include('leagueTables.inc.fixtures')
        @endif
    </div>


    @if(Auth::check())
    @include('leagueTables.inc.adminPanel')
    @endif


</div>

@endsection