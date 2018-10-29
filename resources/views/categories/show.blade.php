@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <h1>{{ $category->name }}</h1>
        </div>
    </div>
    <div class="row">
        @foreach ($category->products as $product)
            <div class="col-sm-4 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h4><span class="badge badge-success">{{ $product->price }} руб.</span></h4>
                        <a href="" class="btn btn-primary">Купить</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection