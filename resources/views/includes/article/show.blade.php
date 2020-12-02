<div class="card" style="width: 80vw">
    <div style="height: 45vw; overflow: hidden; object-fit: cover">
        <img class="card-img-top" style="align-self: center; object-fit: cover; overflow: hidden; height: 45vw" src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($article)) }}" alt="Card image cap">
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="card-text">{!! $article->text !!}</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
