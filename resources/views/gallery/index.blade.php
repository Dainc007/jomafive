@extends('layouts.app')

@section('title' , 'Galerie')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            @include('gallery.inc.galleryNav')
        </div>
    </div>
</div>
@endsection