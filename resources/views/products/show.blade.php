@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $product->name }}</h3>
                </div>
                <div class="card-body">
                    <div>{!! $product->description !!}</div>
                    <div class="image">
                        @foreach($product->images as $img)
                           <img class="img-thumbnail" width="400" src="{{url($img->name)}} "/>
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>

        </div>
    </div>
</div>
@endsection
