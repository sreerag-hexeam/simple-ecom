<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploads(Request $request)
    {
        $imagePath = $request->file('image')->store('image'); 

        session([ 'imagepath' => $imagePath]);
        
    }

    public function store(Request $request)
    {
        // Form validation
            $this->validate($request, [
                
                'name'     => 'required',
                'category' => 'required',
                'price'    => 'required',

            ]);

            $product = new Product;

            $product->name        = $request->name;

            $product->price       = $request->price;

            $product->category_id = $request->category;

            $product->save();

            $product->addMediaFromDisk(Session::get('imagepath'))->toMediaCollection('images');

            Storage::delete(Session::get('imagepath'));

            session([ 'imagepath' => NULL]);

            return to_route('products.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();

        return view('product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
                
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required',

        ]);


        $product->name        = $request->name;

        $product->price       = $request->price;

        $product->category_id = $request->category;

        $product->save();

        $bool = Session::get('imagepath');

        if($bool != NULL)
        {

        $product->clearMediaCollection('images')->addMediaFromDisk(Session::get('imagepath'))->toMediaCollection('images');
        
        Storage::delete(Session::get('imagepath'));
         
        }
         
        session([ 'imagepath' => NULL]);

        
        return to_route('products.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
