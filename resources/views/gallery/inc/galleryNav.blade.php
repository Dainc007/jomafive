<ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-home" aria-selected="true">Wszystkie Galerie</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-addGallery-tab" data-toggle="pill" href="#pills-addGallery" role="tab" aria-controls="pills-profile" aria-selected="false">Dodaj Galerie</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-addPhoto-tab" data-toggle="pill" href="#pills-addPhoto" role="tab" aria-controls="pills-contact" aria-selected="false">Dodaj Zdjęcie do Galerii</a>
    </li>
</ul>
<div class="container tab-content" id="pills-tabContent">

    <div class="tab-pane fade show active" id="pills-all">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h3 class="text-center">Wszystkie Galerie</h3>
            </div>

            @foreach($allGalleries as $gallery)
            <div class="col-sm col-lg">
                {{$gallery->name}}
            <img class="img-fluid" src="http://jomafive.test/images/{{str_replace(' ', '', $gallery->name) }}/{{$gallery->id}}{{str_replace(' ', '',$gallery->name)}}.jpg">
            </div>
            @endforeach

        </div>
    </div>

    <div class="tab-pane fade" id="pills-addGallery">

        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nazwa Galerii</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group mb-1 mt-1 py-1">
                <label for="inputGroupFile04">Wybierz Główne zdjęcie galerii</label>
                <input type="file" multiple class="form-control" name="photo" id="photo" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>
            <button type="submit" class="btn btn-primary">Dodaj Galerie</button>
            @method('POST')
            @csrf
        </form>

    </div>


    <div class="tab-pane fade" id="pills-addPhoto">

        <form method="POST">
            <div class="form-group">
                <label for="gallery">Wybierz Galerię</label>
                <select class="form-control" id="gallery">
                    @foreach($allGalleries as $gallery)
                    <option>{{$gallery->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj zdjęcie do galerii</button>
            @csrf
        </form>

    </div>
</div>