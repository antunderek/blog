@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="item" class="col-md-4 col-form-label text-md-right">Item:</label>

                            <div class="col-md-6">
                                <p id="title">{{ $item->item }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">Link:</label>

                            <div class="col-md-6">
                                <p id="link">{{ $item->link }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
