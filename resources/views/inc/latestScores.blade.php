@if($latest_scores ?? '')
@foreach($latest_scores as $row)
<div class="row justify-content-between shadow-sm py-1">
    <div class="col-4 d-flex justify-content-center align-items-center flex-column">
        <img class="img-fluid" style="max-height:50px;" src='{{asset("storage/images/gallery/shields/$row->hosts.png")}}'>
        <h6 class="text-center">{{$row->hosts}}</h6>
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center flex-column">
    <h6><small>{{$row->date}}</small></h6>
        <h3>{{$row->hosts_goals}} : {{$row->visitors_goals}}</h3>
        <h6><small>{{$row->hour}}</small></h6>
        
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center flex-column">
    <img class="img-fluid" style="max-height:50px;" src='{{asset("storage/images/gallery/shields/$row->visitors.png")}}'>
    <h6 class="text-center">{{$row->visitors}}</h6>
    </div>
</div>
@endforeach
@endif



