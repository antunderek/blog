<div class="card" style="">
    <img class="card-img-top img-fluid" style="vertical-align: center;align-self: center; object-fit: cover;" src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($article->image_path)) }}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="card-text">{!! $article->text !!}</p>
    </div>
</div>
