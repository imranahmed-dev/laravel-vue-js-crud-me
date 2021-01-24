<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:products,title|max:255',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',

        ]);

        $data = new Product();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->price = $request->price;
        $data->description = $request->description;
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded/product'), $imageName);
            $data->image = '/uploaded/product/' . $imageName;
        }
        $data->save();
        return response()->json('Success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product){
            return response()->json($product,200);
        }else{
            return response()->json('failed',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $this->validate($request, [
            'title' => 'required|unique:products,title|max:255,'.$product->id,
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png',

        ]);

        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->price = $request->price;
        $product->description = $request->description;
        $image = $request->file('image');
        if ($image){
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded/product'), $imageName);
            $product->image = '/uploaded/product/' . $imageName;
            $image_path = $product->image;
            @unlink($image_path);

        }
        $product->save();
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        $image_path = $data->image;
        @unlink(public_path($image_path));
        $data->delete();
        return response()->json('Success',200);
    }
}
