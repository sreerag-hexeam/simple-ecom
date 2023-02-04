<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                <div class="bg-blue-100 min-h-screen flex items-center">

                        <div class="w-full">
                            <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">New Order</h2>
                            <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
                            <form action="{{ route('orders.store')}}" method="post">
                                @csrf
                                <div class="mb-10">
                                <label for="name" class="block mb-2 font-bold text-gray-600">Customer Name</label>
                                <input type="text" id="name" name="name" placeholder="Customer Name" class="border border-gray-300 shadow p-3 w-full rounded mb-">
                                @error('name')
                                <p class="text-sm text-red-400 mt-2">Customer name is required</p>
                                @enderror
                                </div>

                                <div class="mb-10">
                                <label for="name" class="block mb-2 font-bold text-gray-600">mobile</label>
                                <input type="text" id="name" name="mobile" placeholder="Mobile" class="border border-gray-300 shadow p-3 w-full rounded mb-">
                                @error('mobile')
                                <p class="text-sm text-red-400 mt-2">Mobile is required</p>
                                @enderror
                               
                                </div>
                                <div class="mb-10">
                                <label for="twitter" class="block mb-2 font-bold text-gray-600">Product</label>
                                    <select class="appearance-none w-full py-1 px-2 bg-white" name="product" id="frm-whatever">
                                    <option value="">Please choose&hellip;</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                    </select>

                                    @error('product')
                                   <p class="text-sm text-red-400 mt-2">Product  is required</p>
                                    @enderror
                               
                                </div>
                                 
                                <div class="mb-10">
                                <label for="name" class="block mb-2 font-bold text-gray-600">Quantity</label>
                                <input type="text" id="name" name="quantity" placeholder="Quantity" class="border border-gray-300 shadow p-3 w-full rounded mb-">
                                @error('quantity')
                                <p class="text-sm text-red-400 mt-2">Quantity is required</p>
                                @enderror
                               
                                </div>
                                <button class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">Submit</button>
                            </form>
                            </div>
                        </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
   </x-app-layout>
