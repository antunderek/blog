<div class="card" style="width: 100">
    <img class="card-img-top img-fluid" style="align-self: center; object-fit: cover;" src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($article)) }}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="card-text">{!! $article->text !!}</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
