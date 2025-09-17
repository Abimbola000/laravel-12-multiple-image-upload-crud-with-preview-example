@extends('layouts.master')

@section('content')
    <div class="card shadow-sm  mt-3" > 
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Create Product</h3>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" id="product">
                @csrf
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea id="editor" name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <input type="file" name="images[]" id="images" multiple  class="form-control @error('images') is-invalid @enderror">

                    @error('images')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 image_gallery" id="image_gallery">
                    
                </div>     
                <div class="mb-3">
                    <button type="submit" class="btn btn-success mt-3"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>

        </div>
    </div>
@endsection
