<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();

        return view('order.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Form validation
         $this->validate($request, [
                
            'name'       => 'required',
            'mobile'     => 'required',
            'product'    => 'required',
            'quantity'   => 'required',

        ]);

        $order = new Order;

        $order->order_id       =  rand(10000,50000);

        $order->customer_name  = $request->name;

        $order->mobile         = $request->mobile;

        $order->product_id     = $request->product;

        $order->quantity       = $request->quantity;

        $order->save();

        return to_route('orders.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::get();

        return view('order.edit',compact('order','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
                
            'name'       => 'required',
            'mobile'     => 'required',
            'product'    => 'required',
            'quantity'   => 'required',

        ]);


        $order->customer_name  = $request->name;

        $order->mobile         = $request->mobile;

        $order->product_id     = $request->product;

        $order->quantity       = $request->quantity;

        $order->save();

        return to_route('orders.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
