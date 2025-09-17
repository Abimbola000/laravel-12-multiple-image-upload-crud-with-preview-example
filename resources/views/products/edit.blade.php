@extends('layouts.master')

@section('content')
    <div class="card shadow-sm mt-3" > 
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit Product</h3>
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

            <form method="post" action="{{ route('products.update',$product) }}" enctype="multipart/form-data" id="product">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"/>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea id="editor" name="description" class="form-control"> {{ old('description', $product->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <input type="file" name="images[]" id="images" multiple  class="form-control @error('images') is-invalid @enderror">

                    @error('images')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="mb-3 image_gallery row" id="image_gallery">
                 </div>
                <div class="mb-3 preview row" id="preview">
                    @foreach($product->images as $image)
                    <div class="col-md-4"><img class='img-thumbnail m-3' src="{{url($image->name)}}" /><button type="button" class="btn btn-danger btn-sm delete" data-url="{{ route('images.destroy',$image->id) }}">X</button></div>
                    @endforeach
                </div>     
                <div class="mb-3">
                    <button type="submit" class="btn btn-success mt-3"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('script') 

$('.delete').on('click',function() {
       
         let button = $(this);
         let url = button.data('url');

        if (confirm("Do you really want to remove this image?") == true) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data:{"_token": "{{ csrf_token() }}"},
                success: function(data) {
                    
                    button.closest('.col-md-4').remove();
                }
            });
        }

        });
     @endpush
