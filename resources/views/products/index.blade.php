
@extends('layouts.app')
@section('content')
 <h1 class="text-center">Laravel 12 Multiple Image Upload CRUD with Preview Example</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm" style="margin-bottom:15px;">
            <span class="glyphicon glyphicon-plus"></span> New Product
        </a>

     @session('success')
      <div class="alert alert-success alert-dismissible fade show">
          <strong>Success!</strong> {{ $value }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      
      </div>
     @endsession

     <table class="table table-striped table-bordered table-hover text-center">
        <thead class="bg-dark">
            <tr>
                <th class="text-center text-white">Sr. No.</th>
                <th class="text-center text-white">Name</th>
                <th class="text-center text-white">Images</th>
                <th class="text-center text-white">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($products as $key=>$product)
          <tr>
            <td>#{{ ++$key }}</td>
            <td>{{ $product->name }}</td>
            <td>
              @foreach($product->images as $img)
                <img class="img-thumbnail" width="100" src="{{url($img->name)}} "/>
              @endforeach
            </td>
            <td>
               <!-- View button -->
                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-success">
                  View
                </a>
             
                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-info">Edit</a> 
                <!-- Delete button -->
                <form action="{{ route('products.destroy', $product) }}" method="POST"  style="display:inline;" onsubmit="return confirm('Delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">  Delete</button>
                </form>
            
            </td>
            
          </tr>
          @empty
          <tr>
            <td  colspan="4" class="fs-3">No Data Found!</td>
          </tr>
        @endforelse
        </tbody>
    </table>

      @endsection