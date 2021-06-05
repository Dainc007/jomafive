<div class="container">
  <div class="timeline">

    @if($goals)
    @foreach($goals as $goal)
    <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
      <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
        <h6 class=" text-light">{{$goal->name}} {{$goal->surname}} </h6>
        <p> <span class="fas fa-football"></span> <img src="https://picsum.photos/20" class="img-fluid" alt="img"> '{{$goal->minute}} <small>({{$goal->teamName}})</small></p>
      </div>
      <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
        <img src="https://picsum.photos/20" class="img-fluid" alt="img">
      </div>
      <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
        <!-- <time>2018-02-23</time> -->
      </div>
    </div>
    @endforeach
    @endif



    <!--  <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
          <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
            <h3 class=" text-light">Timeline Heading</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, eaque amet deleniti hic quas qui cumque delectus aliquid, eius quia quod, quae, aliquam aspernatur facilis. Minima quod corporis dignissimos porro.</p>
          </div>
          <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
            <img src="img/img13.png" class="img-fluid" alt="img">
          </div>
          <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
            <time>2018-02-23</time>
          </div>
        </div>

        <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
          <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
            <h3 class=" text-light">Timeline Heading</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, eaque amet deleniti hic quas qui cumque delectus aliquid, eius quia quod, quae, aliquam aspernatur facilis. Minima quod corporis dignissimos porro.</p>
          </div>
          <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
            <img src="img/img13.png" class="img-fluid" alt="img">
          </div>
          <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
            <time>2018-02-23</time>
          </div>
        </div>

        <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
          <div class="col-10 col-md-5 order-3 order-md-1 timeline-content">
            <h3 class=" text-light">Timeline Heading</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, eaque amet deleniti hic quas qui cumque delectus aliquid, eius quia quod, quae, aliquam aspernatur facilis. Minima quod corporis dignissimos porro.</p>
          </div>
          <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
            <img src="img/img13.png" class="img-fluid" alt="img">
          </div>
          <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
            <time>2018-02-23</time>
          </div>
        </div> -->

  </div>
</div>