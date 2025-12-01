@extends ('admin.maindesign')

@section('view_category')

@if(session('deletecategory_message'))
    <div style="margin-bottom: 10px; color: black; background-color: orangered;">
        {{ session('deletecategory_message') }}
    </div>
@endif

<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Title</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Description</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Quantity</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Prices</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product image</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Category</th>

        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 12px;">{{ $product->product_title }}</td>
            <td style="padding: 12px;">{{ $product->product_description}}</td>
            <td style="padding: 12px;">{{ $product->product_quantity}}</td>
            <td style="padding: 12px;">{{ $product->product_price}}</td>   
            <td style="padding: 12px;">
                <img style="width: 150px;" src="{{asset('products/'. $product->product_image)}}">
            </td>
            <td style="padding: 12px;">{{$product->product_category }}</td>

            <td style="padding: 12px;">
                <a href=""style=color:green;
                   style="color: red; text-decoration:none;"
                   >
                    update
                    <a href=""
                   style="color: red; text-decoration:none;"
                   onclick="return confirm('Are you sure?')">
                    Delete
                  </a>
            </td>
        </tr>
        @endforeach
        {{$products->links()}}
    </tbody>
</table>

@endsection
