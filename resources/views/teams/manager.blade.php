@extends('layouts.app')

@section('content')

@foreach($showManager as $manager)
   <p> Trener: {{$manager->name}}  {{$manager->surname}}</p>
    <p>{{$manager->mail}}</p>
   <p>tel: {{$manager->phoneNumber}} </p>
@endforeach

@foreach($managers as $manager)
    <a href="/manager/show/{{$manager->id}}"> {{$manager->name}} - {{$manager->surname}} </a> 
@endforeach

@endsection
