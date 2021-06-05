@if($fixtures ?? '')
@foreach($fixtures as $row)
<div class="row justify-content-between">
    <div class="col-4 bg-primary">
        <img class="img-fluid d-block mx-auto" style="max-height:50px;" src='{{asset("storage/images/gallery/shields/$row->hosts.png")}}'>
        <h6 class="text-center">{{$row->hosts}}</h6>
    </div>
    <div class="col-4 bg-secondary">
        <h4 class="text-center">{{$row->hour}}</h4>
        <h6 class="text-center">{{$row->date}}</h6>
    </div>
    <div class="col-4 bg-success">
    <img class="img-fluid d-block mx-auto" style="max-height:50px;" src='{{asset("storage/images/gallery/shields/$row->hosts.png")}}'>
    <h6 class="text-center">{{$row->visitors}}</h6>
    </div>
</div>
@endforeach
@endif


