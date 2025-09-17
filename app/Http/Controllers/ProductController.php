<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
             'name' => 'required|string',
             'description' => 'required|string',
             'images'=>'required|array',
             'images.*'=>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

          $product = Product::create(
            [
                'name' =>$request->name ,
                'description' =>$request->description
            ]);
          
            foreach($request->file('images') as $key => $file){
               
               $imageName = time().rand(1,99).'.'.$file->extension();  

                $file->move(public_path('uploads'), $imageName);
                $path = '/uploads/'.$imageName;
                $product->images()->create(['name' => $path]);
          }

         

        return redirect()->route('products.index')->withSuccess( 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         $request->validate([
             'name' => 'required|string',
             'description' => 'required|string',
             'images'=>'nullable|array',
             'images.*'=>'image|sometimes|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

           // If new images are uploaded
          if ($request->hasFile('images')) 
            {

                   foreach ($request->file('images') as $file) {

                        $imageName = time().rand(1,99).'.'.$file->extension(); 
                        $file->move(public_path('uploads'), $imageName);                        
                        $path = '/uploads/'.$imageName;
                        $product->images()->create(['name' => $path]);
                    }
            }

          // Update product fields
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

           return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         // Delete related images
            foreach ($product->images as $image) {
                $imagePath = public_path($image->name);

                if (file_exists($imagePath)) {
                    unlink($imagePath); // remove from storage
                }

                $image->delete(); // remove from database
            }

           $product->delete();
           return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroyImages($id)
    {
        $image  = Image::findOrFail($id);

        $imagePath = public_path($image->name);

         if (file_exists($imagePath)) 
            {
                unlink($imagePath); // remove from storage
            }
        $image->delete();
        return response()->json(['success' => 'Image Deleted Successfully!']);
    }
}
