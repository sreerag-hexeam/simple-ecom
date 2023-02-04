<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                <div class="bg-blue-100 min-h-screen flex items-center">

                        <div class="w-full">
                            <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Edit Product</h2>
                            <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
                            <form action="{{ route('products.update',$product->id)}}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')
                                <div class="mb-10">
                                <label for="name" class="block mb-2 font-bold text-gray-600">Name</label>
                                <input type="text" id="name" name="name" placeholder="Product Name" class="border border-gray-300 shadow p-3 w-full rounded mb-" value="{{$product->name}}">
                                @error('name')
                                <p class="text-sm text-red-400 mt-2">Product name is required</p>
                                @enderror
                                </div>

                                <div class="mb-10">
                                <label for="name" class="block mb-2 font-bold text-gray-600">Price</label>
                                <input type="text" id="name" name="price" placeholder="Price" class="border border-gray-300 shadow p-3 w-full rounded mb-" value="{{$product->price}}">
                                @error('price')
                                <p class="text-sm text-red-400 mt-2">Product price is required</p>
                                @enderror
                               
                                </div>
                                <div class="mb-10">
                                <label for="twitter" class="block mb-2 font-bold text-gray-600">Category</label>
                                    <select class="appearance-none w-full py-1 px-2 bg-white" name="category" id="frm-whatever">
                                    <option value="">Please choose&hellip;</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected="selected"' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                    </select>

                                    @error('category')
                                   <p class="text-sm text-red-400 mt-2">Product category is required</p>
                                    @enderror
                               
                                </div>

                                <div class="mb-10">
                                <label for="name" class="block mb-2 font-bold text-gray-600">Image</label>
                                <input type="file" id="image" name="image" placeholder="Put in your fullname." class="border border-gray-300 shadow p-3 w-full rounded mb-" accept="image/png, image/jpeg, image/gif">
                                @error('image')
                                <p class="text-sm text-red-400 mt-2">Product image is required</p>
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
    @push('scripts')
    <script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() { 
     
    // Register the plugin
    FilePond.registerPlugin(FilePondPluginFilePoster);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);    
    FilePond.registerPlugin(FilePondPluginFileMetadata);    
    FilePond.registerPlugin(FilePondPluginImagePreview);   
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
    
    FilePond.setOptions({
            server:{
                url: '/uploads',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                    },
                    files: [
        {
            // the server file reference
            source: '12345',

            // set type to local to indicate an already uploaded file
            options: {
                type: 'local',

                // optional stub file information
                file: {
                    name: 'image.png',
                    size: 3001025,
                    type: 'image/png',
                },

                // pass poster property
                metadata: {
                    poster: @json($product->getFirstMediaUrl('images')),
                },
            },
        },
    ],
            }); 

     });   
   </script>
   @endpush
</x-app-layout>
