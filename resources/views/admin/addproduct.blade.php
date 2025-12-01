@extends('admin.maindesign')

@section('add_product')
    
    @if(session('product_message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('product_message') }}
        </div>
    @endif

<div class="container-fluid" style="margin-left: 400px;">
    <form action="{{ route('admin.postaddproduct') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="product_title" placeholder="Enter Product Title!" required> <br> <br>
        <textarea name="product_description" style="width: 300px; height: 200px;"> Product Descriptions...
        </textarea> <br> <br>
        <input type="number" name="product_quantity" placeholder="Product quantity here!" required><br> <br>
        <input type="number" name="product_price" placeholder="Product Price here!" required><br> <br>
        <input type="file" name="product_image"><br> <br>
        
        <select name="product_category">
             @foreach ( $categories as $category)
            <option value="{{ $category->category }}">{{ $category->category }}</option>
            @endforeach
        </select><label>Select A Category</label> <br> <br>
        <input type="submit" name="submit" value="Add Product"> <br> <br>
    </form>
</div>
@endsection
